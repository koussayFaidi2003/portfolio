<?php
include 'C:\xampp\htdocs\login\controller\userC.php';
include "bars.php";
$c = new userC();
$tab = $c->listusers();
?>
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            width: 30%;
            margin: 50px auto; /* Marge automatique en haut et en bas, centrée horizontalement */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: -100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: -9999px;
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
<center>
    <h1>List of users</h1>
    <h2>
        <a href="adduser.php">Add user</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
    <th>Id user</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Password</th>
        <th>Tel</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    foreach ($tab as $user) {
    ?>

        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['nom']; ?></td>
            <td><?= $user['prenom']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['psw']; ?></td>
            <td><?= $user['tel']; ?></td>
            
            
            <td align="center">
                <form method="POST" action="updateuser.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $user['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="deleteuser.php?id=<?php echo $user['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
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
<div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 60px;" href="pdf3.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> PDF</a>
    </div>
</body>
</html>