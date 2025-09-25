<?php

include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Flight.php';
$error = "";

// create reservation
$flight = null;
// create an instance of the controller
$flightC = new FlightC();


if (
    isset($_POST["lieuD"]) &&
    isset($_POST["lieuA"]) &&
    isset($_POST["dateD"])&&
    isset($_POST["dateA"]) &&
    isset($_POST["numberp"]) &&
    isset($_POST["billet"])
) {
    if (
        !empty($_POST["lieuD"]) &&
        !empty($_POST["lieuA"]) &&
        !empty($_POST["dateD"])&&
        !empty($_POST["dateA"]) &&
        !empty($_POST["numberp"]) &&
        !empty($_POST["billet"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $flight = new Flight(
            null,
            $_POST['lieuD'],
            $_POST['lieuA'],
            $_POST['dateD'],
            $_POST['dateA'],
            $_POST['numberp'],
            $_POST['billet']
        );
        var_dump($flight);
        
        $flightC->updateFlight($flight, $_POST['idFlight']);

        header('Location:listFlight.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>

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

		<!-- logo img -->
		<link rel="shortcut icon" type="image/icon" href="../View/front/assets/logo/logo1.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="../View/front/assets/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="../View/front/assets/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="../View/front/assets/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="../View/front/assets/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="../View/front/assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="../View/front/assets/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="../View/front/assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="../View/front/assets/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="../View/front/assets/css/bootsnav.css"/>

		<!--style.css-->
		<link rel="stylesheet" href="../View/front/assets/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="../assets/css/responsive.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0e0e0;;
        }

        #form-container {
			width: 80%;
			margin: 0 auto;
			padding: 20px;
			background-color: #f8f8f8;
			border-radius: 10px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			
        }

        table {
            width: 30%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="reset"] {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }
    </style> 
<body>
    <button><a href="listFlight.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
     <!-- main-menu Start -->
     <header class="top-area">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="logo">
								<a href="index.html">
									Fly<span>Tasy</span>
								</a>
							</div><!-- /.logo-->
						</div><!-- /.col-->
						<div class="col-sm-10">
							<div class="main-menu">
							
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<i class="fa fa-bars"></i>
									</button><!-- / button-->
								</div><!-- /.navbar-header-->
								<div class="collapse navbar-collapse">		  
									<ul class="nav navbar-nav navbar-right">
										<li class="smooth-menu"><a href="#home">home</a></li>
										<li class="smooth-menu"><a href="#gallery">Destination</a></li>
										<li class="smooth-menu"><a href="#pack">Reservations </a></li>
										<li class="smooth-menu"><a href="#spo">Special Offers</a></li>
										<li class="smooth-menu"><a href="#blog">blog</a></li>
										<li class="smooth-menu"><a href="#subs">subscription</a></li>
										<li>
											<button class="book-btn">Show List
											</button>
										</li><!--/.project-btn--> 
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					</div><!-- /.row -->
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div><!-- /.header-area -->

		</header><!-- /.top-area-->
		<!-- main-menu End -->
    <!--packages start-->
		<section id="pack" class="packages">
			<div class="container">
				<div class="gallary-header text-center">
					<h2>
						Reservations
					</h2>
				</div><!--/.gallery-header-->
				<div class="packages-content">
					<div class="row">

						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="../View/front/assets/images/packages/p1.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>italy <span class="pull-right">$499</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 daays 6 nights
											</span>
											<i class="fa fa-angle-right"></i>  5 star accomodation
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  transportation
											</span>
											<i class="fa fa-angle-right"></i>  food facilities
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 review</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											book now
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->

						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="../View/front/assets/images/packages/p2.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>england <span class="pull-right">$1499</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 daays 6 nights
											</span>
											<i class="fa fa-angle-right"></i>  5 star accomodation
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  transportation
											</span>
											<i class="fa fa-angle-right"></i>  food facilities
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 review</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											book now
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="../View/front/assets/images/packages/p3.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>france <span class="pull-right">$1199</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 daays 6 nights
											</span>
											<i class="fa fa-angle-right"></i>  5 star accomodation
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  transportation
											</span>
											<i class="fa fa-angle-right"></i>  food facilities
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 review</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											book now
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						

					</div><!--/.row-->
				</div><!--/.packages-content-->
			</div><!--/.container-->

		</section><!--/.packages-->
		<!--packages end-->
    <?php
    if (isset($_POST['idFlight'])) {
        $flight = $flightC->showFlight($_POST['idFlight']);
        
    ?>

        <form action="" method="POST">
        <table style="margin: 0 auto;">
                <tr>
                    <td><label for="idFlight">id Flight :</label></td>
                    <td>
                        <input type="hidden" id="idFlight" name="idFlight"  value="<?php echo $flight['idFlight']; ?>" />
                        <span id="erreuridFlight" style="color: red"></span>
                    </td>
                </tr>
            <tr>
                <td><label for="lieuD">Departure :</label></td>
                <td>
                    <input type="text" id="lieuD"  onkeyup="validld()" name="lieuD" value="<?php echo $flight['lieuD']?>"/>
                    <span id="erreurlieuD" style="color: red"></span>
                    <span id="succeslieuD" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="lieuA">Destiantion:</label></td>
                <td>
                <input type="text" id="lieuA"  onkeyup="validla()" name="lieuA"  value="<?php echo $flight['lieuA'] ?>"/>
                    <span id="erreurlieuA" style="color: red"></span>
                    <span id="succeslieuA" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateD">Start Date :</label></td>
                <td>
                    <input type="date" id="dateD" name="dateD" value="<?php echo $flight['dateD'] ?>"/>
                    <span id="erreurdateD" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateA">End Date :</label></td>
                <td>
                    <input type="date" id="dateA" name="dateA" value="<?php echo $flight['dateA'] ?>"/>
                    <span id="erreurdateF" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="numberp">Capacity :</label></td>
                <td>
                <input type="text" id="numberp" onkeyup="validerNumberp()" name="numberp" value="<?php echo $flight['numberp'] ?>"/>
                    <span id="erreurnumberp" style="color: red"></span>
                    <span id="succesnumberp" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="billet">Ticket :</label></td>
                <td>
                    <input type="text" id="billet" onkeyup="validerbillet()" name="billet" value="<?php echo $flight['billet'] ?>"/>
                    <span id="erreurbillet" style="color: red"></span>
                    <span id="succesbillet" style="color: green"></span>   
                </td>
            </tr>
            <td>
                <input type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
    <script src="ControleSaisie_Flight.js"></script>
    <?php
    }
    ?>
</body>

</html>