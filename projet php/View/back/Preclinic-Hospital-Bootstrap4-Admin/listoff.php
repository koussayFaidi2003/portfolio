<?php
include "C:/xampp/htdocs/tacheOffres/Controller/OffresC.php";
include 'bars.php';
$c = new OffresC();
$tab = $c->listOffres();

$error="";

?>
<html class="no-js"  lang="en">
<style>    <hr>
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
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-right: 30px;
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
<div id="form_container">
<center>
    <h1>List of destination</h1>
    <h2>
        <a href="adddestination.php">List of Offers</a>
    </h2>
</center>
</div>
<table  border="2" align="center" width="65%" >
    <tr>
        <th>Id offer</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date start</th>
        <th>Date finish</th>
        <th>Destination</th>
        <th>Price</th>
        <th>Nomber of passengers</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $Offres) {
    ?>

        <tr>
            <td><?= $Offres['id_offre']; ?></td>
            <td><?= $Offres['nom_offre']; ?></td>
            <td><?= $Offres['description_offre']; ?></td>
            <td><?= $Offres['date_debut_validite']; ?></td>
            <td><?= $Offres['date_fin_validite']; ?></td>
            <td><?= $Offres['destination']; ?></td>
            <td><?= $Offres['prix']; ?></td>
            <td><?= $Offres['nombre_min_passagers']; ?></td>
            <td align="center">
                <form method="POST" action="modifieroff.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $Offres['id_offre']; ?> name="id_offre">
                </form>
            </td>
            <td>
                <a href="supprimeroff.php?id=<?php echo $Offres['id_offre']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<div class="row">
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 150px;" href="ajouoff.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add an Offer</a>
    </div>  
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 143px;" href="sendmail.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Send an Email</a>
    </div>
</div>
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
</body>
</html>