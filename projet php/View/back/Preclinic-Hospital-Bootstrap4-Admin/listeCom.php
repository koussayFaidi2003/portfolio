<?php
include "C:/xampp/htdocs/blog/controller/blogC.php"; // Assuming you have a BlogC class
include "bars.php";
$c = new BlogC();
$tab = $c->listblog();

?>

<!DOCTYPE html>
<html lang="en">


<!-- blog-details23:51-->
<head>
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
</head>
<body>
	<div id="form_container">

    
              
<center>
    <h1>List of comment</h1>
    <h2>
        <a href="blog-details.php">Add comment</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id </th>
        <th>email</th>
        <th>commentaire</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    foreach ($tab as $blog) {
    ?>
        <tr>
            <td><?= $blog['id']; ?></td>
            <td><?= $blog['title']; ?></td>
            <td><?= $blog['content']; ?></td>
            <td align="center">
                <form method="POST" action="updateblog.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $blog['id']; ?> name="id">
                    </form>
            </td>
            <td>
                <a href="deleteblog.php?id=<?php echo $blog['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<div class="row">
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 150px;" href="blog-details.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Commment</a>
    </div>  
</div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- blog-details23:56-->
</html>