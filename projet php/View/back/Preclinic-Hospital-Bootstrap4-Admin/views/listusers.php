<?php
include 'C:\xampp\htdocs\login\controller\userC.php';
$c = new userC();
$tab = $c->listusers();
?>
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
            <td><?= $user['tel']; ?></td>
            <td><?= $user['psw']; ?></td>
            
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
<div class="row"> 
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 143px;" href="C:\xampp\htdocs\login\views\sendmail.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Send an Email</a>
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