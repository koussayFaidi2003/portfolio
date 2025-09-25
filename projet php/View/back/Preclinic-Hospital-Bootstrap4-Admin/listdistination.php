<?php
include "C:/xampp/htdocs/INTEG MALEK OUMA/Controller/destinationC.php";
include "bars.php";
$c = new DestinationC();
$tab = $c->listdistination();
$error = "";


?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
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
</style>
<body>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
    </style>
    <a href="listdistination.php">Back to list </a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
    </style>
<body>
<div id="form-container">
<center>
    <h1>List of destination</h1>
    <h2>
        <a href="adddestination.php">Add destination</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id destination</th>
        <th>Pays</th>
        <th>Ville</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $destination) {
    ?>

        <tr>
            <td><?= $destination['id']; ?></td>
            <td><?= $destination['pays']; ?></td>
            <td><?= $destination['ville']; ?></td>
            <td align="center">
                <form method="POST" action="updatedestination.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $destination['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="deletedestination.php?id=<?php echo $destination['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<div class="row"> 
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 60px;" href="testphpmailer.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Send an Email</a>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 60px;" href="pdf2.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> PDF</a>
    </div>
</div>
</div>
</body>
</html>