<?php
// Importations nécessaires
include "C:/xampp/htdocs/INTEG MALEK OUMA/Controller/blogC.php"; // Assuming you have a BlogC class
include "C:/xampp/htdocs/INTEG MALEK OUMA/Model/blog.php";
include "bars.php";




// create an instance of the controller
$blogC = new BlogC();

if (
    isset($_POST["title"]) &&
    isset($_POST["content"])
) {
    if (
        !empty($_POST['title']) &&
        !empty($_POST["content"])
    ) {
        $blog = new Blog(
            null,
            $_POST['title'],
            $_POST['content']
        );

        $blogC->addBlog($blog);
        header('Location: listblog.php');
    } else {
        $error = "Missing information";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Blog </title>
    <link rel="stylesheet" href="style.css">
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Ajouter un Offre-Admin</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    
    <a href="listeCom.php">Back to list</a>
    <hr>


    <form action="" method="POST">
    <div class="page-wrapper">
    <div class="content">
    <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Blog</h4>
                    </div>
                </div>
    <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
										<label  for="title">title :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="title" name="title">
                    					<span class="error-message" id="erreurTitle" style="color: red"></span>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
										<label  for="content">content :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="content" name="content">
                    					<span class="error-message" id="erreurContent" style="color: red"></span>
                                    </div>
                            </div>
								<div class="m-t-20 text-center">
                                <button input type="submit" class="btn btn-primary submit-btn">Add blog</button>
                            </div>
					</div>
                </div>
            </div>
    </form>
    <script src="email.js"></script>
</body>
<div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>   
</div> 
</html>
