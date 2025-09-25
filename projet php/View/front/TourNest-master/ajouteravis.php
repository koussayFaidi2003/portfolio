<?php
// Importations nécessaires

include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/AvisC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Avis.php';


$error = "";
$successMessage = "";

// Création d'une instance du contrôleur
$AvisCC = new AvisC();
$id_offre = null; // Initialize $id_offre with a default value
// Fetch the offers from the database
$offres=$AvisCC->showOffres($id_offre);

$p = new AvisC();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["idoffre"])){
        $id_offre = $_POST['idoffre'];
        $list = $p->showOffres($id_offre);
    }
}

 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["idoffre"]) &&
        isset($_POST["id_utilisateur"]) &&
        isset($_POST["note"]) &&
        isset($_POST["avis"]) &&
        !empty($_POST["idoffre"]) &&
        !empty($_POST["id_utilisateur"])&&
        !empty($_POST["note"]) &&
        !empty($_POST["avis"])
    ) {
        $Avis = new Avis(
            null,
            $_POST["idoffre"] ,
            $_POST["id_utilisateur"] ,
            $_POST["note"] ,
            $_POST["avis"] 
        );

        $AvisCC->ajouteravis($Avis);
        $successMessage = "Avis ajoutée avec succès.";
    } else {
        $error = "Informations manquantes.";
    }
}
?>
<html lang="en">
<head>
    	<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
		<title>FlyTasy</title>

		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/FlyTasy_icon.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="assets/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="assets/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="assets/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css"/>

		<!--style.css-->
		<link rel="stylesheet" href="assets/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="assets/css/responsive.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        </style>
<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="logo">
								<a href="main.php">
									<img src="assets/logo/logoFlytasys.png"/> Fly<span>tasy</span>
								</a>
							</div><!-- /.logo-->
  

						</div><!-- /.col-->
						<div class="col-sm-10">
							<div class="main-menu">
								<div class="collapse navbar-collapse">
									<ul class="nav navbar-nav navbar-right">
									</br>
										<li><a href="main.php">Home</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					</div><!-- /.row -->
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: url('assets/images/home/sky2.jpg') center center fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .wrapper {
        border: 2px solid transparent;
        background: transparent;
        backdrop-filter: blur(20px); 
        padding: 40px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        width: 450px;
        height: 380px;
        position: bottom;
        border-radius:10px;
        transform: translate(110%, 30%);
        text-align: center; 
        box-shadow: 0 0 50px rgba(255, 255, 255, 0.2);
        }
        .form-box {
            border: 2px solid #b7b5b5;
            font-family: "Verdana", sans-serif;
            color:rgba(91, 89, 89, 0.5);
            padding: 25px;
            width: 400px;
            height:50px;
            border-radius: 3px;
        }
    </style>
    <title> Avis </title>
</head>

<body>
    <div id="error">
        <?php echo $error; ?>
    </div>
    <div class="wrapper">
        <form action="" method="POST">
        <!-- ... Your HTML code ... -->

<h2 style="color: white; font-family: 'Arial', sans-serif;">Give your rating!!</h2>

<div class="form-box">
    <label for="idoffre">Choose the Offer:</label>
    <select name="idoffre" id="idoffre">
<?php
foreach ($offres as $Offres) {
echo '<option value="' . $Offres['id_offre'] . '">' . $Offres['nom_offre'] . '</option>';
        }
        ?>
    </select>
</div>

<div class="form-box">
    <label for="id_utilisateur">User's ID:</label>
    <input type="number" id="id_utilisateur" name="id_utilisateur" />
    <span id="erreurid_utilisateur" style="color: red"></span>
</div>

<div class="form-box">
    <label for="note">Rating :</label>
    <input type="number" id="note" name="note" />
    <span id="erreurnote" style="color: red"></span>
</div>

<div class="form-box">
    <label for="avis">Review :</label>
    <input type="text" id="avis" name="avis" />
    <span id="erreuravis" style="color: red"></span>
</div>

<style>
    .form-box {
        margin-bottom: 10px;
    }
</style>
                <td style="margin-top: 10px;">
    <input type="submit" value="Save" style="background-color: blue; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; cursor: pointer; border-radius: 4px;">
</td>
<td style="margin-top: 10px;">
    <input type="reset" value="Reset" style="background-color: blue; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; cursor: pointer; border-radius: 4px;">
</td>
                </table>

        </form>
</body>

</html>