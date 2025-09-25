<?php
include "C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php";
include 'bars.php';
$f = new FlightC();
$tab = $f->listFlight2();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Flights</title>
    
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
            background-color: #f4f4f4;
        }
    </style>
</head>
<body >        
    
<center>
    <div style="text-align: center; padding-top: 100px;">
    <h1>List of Flights</h1>
    <h2>
        <a href="addFlight2.php">Add Flight</a>
    </h2>
</center>
<table border="2" align="center" width="65%">
    <tr>
        <th>Id Flight</th>
        <th>Departure</th>
        <th>Destination</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Number of persons</th>
        <th>Ticket</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $Flight) {
    ?>

        <tr>
            <td><?= $Flight['idFlight']; ?></td>
            <td><?= $Flight['lieuD']; ?></td>
            <td><?= $Flight['lieuA']; ?></td>
            <td><?= $Flight['dateD']; ?></td>
            <td><?= $Flight['dateA']; ?></td>
            <td><?= $Flight['numberp']; ?></td>
            <td><?= $Flight['billet']; ?></td>
            <td align="center">
                <form method="POST" action="updateFlight2.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $Flight['idFlight']; ?> name="idFlight">
                </form>
            </td>
            <td>
                <a href="deleteFlight.php?id=<?php echo $Flight['idFlight']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<br>
<?php
// Display success message if available
if (isset($_GET['successMessage'])) {
    $successMessage = $_GET['successMessage'];
    echo '<div class="success-box" id="successMessage">' . $successMessage . '</div>';
}
?>

<div class="row">
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 150px;" href="addFlight2.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add a Flight</a>
    </div>  
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 143px;" href="sendemail" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Send an Email</a>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20" style="float: right;">
        <a style="margin-top: 40px; margin-right: 143px;" href="searchFlight.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Search Flight</a>
    </div>
</div>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var successMessage = document.getElementById("successMessage");
        if (successMessage) {
            successMessage.style.display = "block";

            setTimeout(function () {
                successMessage.style.display = "none";
            }, 3000);
        }
    });
</script>