<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/AvisC.php';
include 'bars.php';

$c = new AvisC();
$tab = $c->listavis();

?>
<html class="no-js"  lang="en">
<body>
<div class="page-wrapper">
            <div class="content">
                <div class="row">
                <div class="col-sm-12">
                        <h4 class="page-title">Our Offers!</h4>
                    </div>
                </div>
        </div>
<table border="1" align="center" width="70%">
    <tr>
        <th>Review' ID</th>
        <th>Offers ID</th>
        <th>Id utilisateur</th>
        <th>Rating</th>
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