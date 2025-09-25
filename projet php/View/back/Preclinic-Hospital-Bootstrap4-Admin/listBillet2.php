<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/BilletC.php';
include 'bars.php';
$b = new BilletC();
$tab = $b->listBillet2();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ticket </title>
   

</head>
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
            margin-right: 20px;
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
<center>
    <div style="text-align: center; padding-top: 100px;">
        <h1>List of Tickets</h1>
        <h2><a href="addBillet.php">Add Ticket</a></h2>
    </div>
</center>
<table border="2" align="center" width="65%">
    <tr>
        <th>Id Ticket</th>
        <th>Flight Number</th>
        <th>User Name</th>
        <th>Purchase's Date</th>
        <th>Seat Number</th>
        <th>Price</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <!-- Add a button for generating PDF -->
    <div style="text-align: center; margin-top: 20px; ">
    <a href="pdf.php" class="btn btn-primary">Generate PDF</a>
    </div>
    <?php
    foreach ($tab as $Billet) {
    ?>

        <tr>
            <td><?= $Billet['idBillet']; ?></td>
            <td><?= $Billet['flightNumber']; ?></td>
            <td><?= $Billet['UserName']; ?></td>
            <td><?= $Billet['Date_Purchase']; ?></td>
            <td><?= $Billet['Seat_Number']; ?></td>
            <td><?= $Billet['Price']; ?></td>
            <td align="center">
                <form method="POST" action="updateBillet.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $Billet['idBillet']; ?> name="idBillet">
                </form>
            </td>
            <td>
                <a href="deleteBillet.php?id=<?php echo $Billet['idBillet']; ?>">Delete</a>
            </td>
        </tr>
		
    <?php
    }
    
    ?>
</table>
<br>
<div class="row">
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 150px;" href="addBillet.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add a Ticket</a>
    </div>  
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 143px;" href="sendemail" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Send an Email</a>
    </div>
</div>
</body>
</html>