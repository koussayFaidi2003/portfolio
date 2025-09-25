<?php
// Importations nécessaires
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/OffresC.php';
$c = new OffresC();
$tab = $c->listOffres();

$idOffre = isset($_POST['idoffre']) ? $_POST['idoffre'] : null;

$d = new OffresC();

$offresC=new OffresC();
$offres=$offresC->showOffres($idOffre);



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["Offres"]) && isset($_POST["search"]))
		$id_offre=$_POST['Offres'];
		$list=$d->showavis($idOffre);
	}
?>
<!doctype html>
<html class="no-js"  lang="en">

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
		<style>
        body {
            background: url('assets/images/home/background.jpg') center center fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
		.offer-box:first-child {
   			 margin-top: 100px;
		}
		.offer-box {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
        }

        .offer-box h2 {
            margin-bottom: 10px;
        }

        .offer-box p {
            margin-bottom: 5px;
        }

        .offer-box button {
            background-color:#00bfff ;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>

	</head>
	<body>
	<header class="top-area">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="logo">
								<a href="main.php">
									<img src="assets/logo/logoFlytasys.png"/>     Fly<span>tasy</span>
								</a>
							</div><!-- /.logo-->
						</div><!-- /.col-->
						<div class="col-sm-10">
							<div class="main-menu">
								<div class="collapse navbar-collapse">
									<ul class="nav navbar-nav navbar-right">
									</br>
									<form action="" method="POST">
                    					<label for="idoffre">Choose the Offre's ID:</label>
										<select name="idoffre" id="idoffre">
											<?php
											foreach ($offres as $Offres){
												echo '<option value="' . $Offres['id_offre'] . '">' .$Offres['nom_offre'] . "</option>";
											}
											?>
                    					<input type="submit" value="Show reviews and rating for this offer" name="search">
                					</form>		 
										<li><a href="main.php">Home</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div>

		</header>
		<div class="container">
        <div class="row">
		<div class="col-sm-12">
    <?php foreach ($tab as $Offres) : ?>
        <div class="offer-box">
            <h2><?= $Offres['nom_offre']; ?></h2>
            <p><?= $Offres['description_offre']; ?></p>
            <p>Date start: <?= $Offres['date_debut_validite']; ?></p>
            <p>Date end: <?= $Offres['date_fin_validite']; ?></p>
            <p>Destination: <?= $Offres['destination']; ?></p>
            <p>Price: <?= $Offres['prix']; ?></p>
            <p>Number of passengers: <?= $Offres['nombre_min_passagers']; ?></p>

			<a href="ajouteravis.php">
  				<button type="button">Review this Offer!</button>
			</a>

            <p>Avis:</p>
			<?php  $idOffre = $Offres['id_offre'];
			if (isset($list)) { ?>
    			<?php foreach ($list as $Avis) {
        			if ($Avis['idoffre'] === $idOffre) { ?>
            			<li>Rating: <?= $Avis['note'] ?> - Review: <?= $Avis['avis'] ?></li>
        			<?php } 
    				} ?>
					<?php } else { ?>
    					<p>No review for this offer.</p>
					<?php } ?>
        </div>
    <?php endforeach; ?>
</div>
		<!-- main-menu End -->	
		<script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

		<!--owl.carousel.js-->
        <script  src="assets/js/owl.carousel.min.js"></script>

        <!-- jquery.sticky.js -->
		<script src="assets/js/jquery.sticky.js"></script>

        <!--datepicker.js-->
        <script  src="assets/js/datepicker.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>
	</body>
</html>