<?php
// Importations bécessaires
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/GuideC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/guide.php';
$error = "";

// create client

// create an instance of the controller
$guideC = new GuideC();
if(isset($_REQUEST['add'])){
        $guide = new Guide(
            null,
            $_POST['specailite']
        );

        $guideC->addguide($guide);
        header('Location:listguide.php');
     
}
else
        $error = "Missing information";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> guide </title>
    <link rel="stylesheet" href="style.css">
	
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
		<link rel="shortcut icon" type="image/icon" href="../assets2/logo/favicon.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="../assets2/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="../assets2/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="../assets2/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="../assets2/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="../assets2/css/owl.carousel.min.css">
		<link rel="stylesheet" href="../assets2/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="../assets2/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="../assets2/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="../assets2/css/bootsnav.css"/>

		<!--style.css-->
		<link rel="stylesheet" href="../assets2/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="../assets2/css/responsive.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>

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
            width: 50%;
            margin: 50px auto; /* Marge automatique en haut et en bas, centrée horizontalement */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
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
        .collapse navbar-collapse {
    background-color: #82cef8;
}

		.main-menu  .nav  li.active a,
		.main-menu  .nav  li a:hover,
		.main-menu .nav  li a:focus{
    	color: #24d26d;
    	background: color #82cef8;;
}
		/* Styles spécifiques pour la navbar avec la classe main-menu */
.main-menu {
    border: 1px solid #87CEFA;
	background-color: #87CEFA;
	/* Couleur de la bordure bleu ciel */
}
/* ... Autres styles ... */
    </style>
    <div id="form-container">
		<center><h1>Add guide</h1><center>

    <form  action="" method="POST">

                    <input type="text" id="specailite" name="specailite" />
                <input type="submit" name="add" id="add" value="Save">
                <input type="reset" value="Reset">

    </form>
	<script>
		var submitBtn = document.getElementById('add');

// add event listener to the submit button
submitBtn.addEventListener('click', function(event) {
  // get the input field
  var input = document.getElementById('specailite'); 
  // get the input value
  var value = input.value;

  // check if the input contains only letters and spaces
  if (/^[a-zA-Z\s]+$/.test(value)) {
    // input is valid, allow the form to submit
  } else {
    // input contains non-letter characters, preven
event.preventDefault();
    // display error message next to the input field
    var errorMsg = document.createElement('span');

    errorMsg.innerText = 'Le champ specailite ne doit contenir que des lettres .';
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  }
});
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