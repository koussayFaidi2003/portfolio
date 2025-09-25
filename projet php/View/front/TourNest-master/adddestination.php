<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/destinationC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/destination.php';
$error = "";
$destinationC= new DestinationC();


if(isset($_REQUEST['add'])){
	$destination = new Destination(
		null,
		$_POST['pays'],
		$_POST['ville'],

	);

	$destinationC->adddestination($destination);
	header('Location:listdistination.php');
 
}
else
	$error = "Missing information";

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
					
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div>

   
		</section>
    <a href="listdistination.php">Back to list </a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>
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
		.main-menu:hover, .main-menu:focus {
    border: none;
}
.main-menu {
    border: none;  /* Supprimer la bordure de la barre de navigation */
    background-color: transparent !important;  /* Fond transparent */
    padding: 0;  /* Supprimer le padding */
}

.main-menu .nav li {
    border: none;  /* Supprimer la bordure des éléments li dans la navbar */
}

.main-menu .nav li a {
    color: white;  /* Couleur du texte en blanc */
    background-color: transparent !important;  /* Fond transparent */
    padding: 10px 15px;  /* Ajouter du padding au texte */
    transition: color 0.3s;  /* Ajouter une transition pour une animation en douceur */
}

.main-menu .nav li a:hover,
.main-menu .nav li a:focus {
    color: blue;  /* Couleur du texte en bleu au survol */
}

    </style> 
	<body>
	<div id="form-container">
	<center><h1>Add destination</h1><center>
    <form action="" method="POST">
        <h4>pays:</h4><input type="text" id="pays" name="pays" />
       <h4>ville:</h4> <input type="text" id="ville" name="ville" />
        <input type="submit" name="add" id="add" value="Save">
        <input type="reset" value="Reset">
    </form>
    <script>
        var submitBtn = document.getElementById('add');

        // add event listener to the submit button
        submitBtn.addEventListener('click', function (event) {
            // get the input field for pays
            var inputPays = document.getElementById('pays');
            var valuePays = inputPays.value;

            // get the input field for ville
            var inputVille = document.getElementById('ville');
            var valueVille = inputVille.value;

            // check if both pays and ville contain only letters and spaces
            var isValidPays = /^[a-zA-Z\s]+$/.test(valuePays);
            var isValidVille = /^[a-zA-Z\s]+$/.test(valueVille);

            if (isValidPays && isValidVille) {
                // inputs are valid, allow the form to submit
            } else {
                // inputs contain non-letter characters, prevent form submission
                event.preventDefault();

                // display error message next to the respective input fields
                if (!isValidPays) {
                    displayErrorMessage(inputPays, 'Le champ "Pays" ne doit contenir que des lettres.');
                }

                if (!isValidVille) {
                    displayErrorMessage(inputVille, 'Le champ "Ville" ne doit contenir que des lettres.');
                }
            }
        });

        function displayErrorMessage(input, message) {
            // remove any existing error message
            var existingError = input.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            // create and display new error message
            var errorMsg = document.createElement('span');
            errorMsg.className = 'error-message';
            errorMsg.innerText = message;
            input.parentNode.insertBefore(errorMsg, input.nextSibling);
        }
    </script>
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