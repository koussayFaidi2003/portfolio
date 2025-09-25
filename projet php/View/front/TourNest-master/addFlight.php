<?php
// Importations bécessaires
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Flight.php';

$error = "";

// create flight
$Flight = null;
// create an instance of the controller
$FlightC = new FlightC();

if (
    isset($_POST["lieuD"]) &&
    isset($_POST["lieuA"]) &&
    isset($_POST["dateD"])&&
    isset($_POST["dateA"]) &&
    isset($_POST["numberp"]) &&
    isset($_POST["billet"]) 
) {
	//var_dump($_POST);
    if (
        !empty($_POST["lieuD"]) &&
        !empty($_POST["lieuA"]) &&
        !empty($_POST["dateD"])&&
        !empty($_POST["dateA"]) &&
        !empty($_POST["numberp"]) &&
        !empty($_POST["billet"])  
    ) {
        $Flight = new Flight(
            null,
            $_POST['lieuD'],
            $_POST['lieuA'],
            $_POST['dateD'],
            $_POST['dateA'],
            $_POST['numberp'],
            $_POST['billet']
        );

        $FlightC->addFlight($Flight);
        header('Location:listFlight.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
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
		<title>Travel</title>

		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

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
</head>
<style>
           body {
            background: url('assets/images/home/sky2.jpg') center center fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
		#form-container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f8f8;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

.table-container {
    width: 30%;
    float: right;
    margin-top: 200px;
    margin-bottom: 20px;
    margin-right: 520px; /* Adjust this value as needed */
}

table {
    width: 100%;
    border-collapse: collapse;
}

/* Other styles for input places go here */
input[type="text"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

input[type="submit"],
input[type="reset"] {
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #45a049;
}

    </style>   

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
										<li><a href="main.php">Home</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					</div><!-- /.row -->
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div>

		</header>
    <div id="error">
        <?php echo $error; ?>
    </div>

    
        <form action="" method="POST">
        <div class="table-container">
    		<table>
                <tr>
                    <td><label for="idFlight">id Flight :</label></td>
                    <td>
                        <input type="hidden" id="idFlight" name="idFlight"  />
                        <span id="erreuridFlight" style="color: red"></span>
                    </td>
                </tr>
            <tr>
                <td><label for="lieuD">Departure :</label></td>
                <td>
                    <input type="text" id="lieuD"  onkeyup="validld()" name="lieuD" />
                    <span id="erreurlieuD" style="color: red"></span>
                    <span id="succeslieuD" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="lieuA">Destiantion:</label></td>
                <td>
                <input type="text" id="lieuA"  onkeyup="validla()" name="lieuA" />
                    <span id="erreurlieuA" style="color: red"></span>
                    <span id="succeslieuA" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateD">Start Date :</label></td>
                <td>
                    <input type="date" id="dateD" name="dateD" />
                    <span id="erreurdateD" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateA">End Date :</label></td>
                <td>
                    <input type="date" id="dateA" name="dateA" />
                    <span id="erreurdateF" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="numberp">Capacity :</label></td>
                <td>
                <input type="text" id="numberp" onkeyup="validerNumberp()" name="numberp" />
                    <span id="erreurnumberp" style="color: red"></span>
                    <span id="succesnumberp" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="billet">Ticket :</label></td>
                <td>
                    <input type="text" id="billet" onkeyup="validerbillet()" name="billet" />
                    <span id="erreurbillet" style="color: red"></span>
                    <span id="succesbillet" style="color: green"></span>   
                </td>
            </tr>
            <td>
    <input type="submit" value="Save" style="background-color: blue; color: white;">
</td>
<td>
    <input type="reset" value="Reset" style="background-color: blue; color: white;">
</td>

        </table>
		</div>
    </form>
    <script src="ControleSaisie_Flight.js"></script>
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