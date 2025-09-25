<?php
include 'C:/xampp/htdocs/tacheOffres/Controller/AvisC.php';
include 'bars.php';

$c = new AvisC();
$tab = $c->listavis();

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
            margin: 50px auto; /* Marge automatique en haut et en bas, centrée horizontalement */
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
        <a href="adddestination.php">List of Review</a>
    </h2>
</center>
</div>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Review</th>
        <th>Id offer</th>
        <th>Id user</th>
        <th>Note</th>
        <th>Review</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $Avis) {
    ?>

        <tr>
            <td><?= $Avis['id_avis']; ?></td>
            <td><?= $Avis['idoffre']; ?></td>
            <td><?= $Avis['id_utilisateur']; ?></td>
            <td><?= $Avis['note']; ?></td>
            <td><?= $Avis['avis']; ?></td>
            <td align="center">
                <form method="POST" action="modifieravis.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $Avis['id_avis']; ?> name="id_avis">
                </form>
            </td>
            <td>
                <a href="supprimeravis.php?id=<?php echo $Avis['id_avis']; ?>">Delete</a>
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
</body>
</html>