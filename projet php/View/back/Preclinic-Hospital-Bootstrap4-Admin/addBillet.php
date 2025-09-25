<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/BilletC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Billet.php';
include 'bars.php';
$error = "";

// create billet
$Billet = null;
// create an instance of the controller
$BilletC = new BilletC();

if (
    isset($_POST["flightNumber"]) &&
    isset($_POST["UserName"]) &&
    isset($_POST["Date_Purchase"])&&
    isset($_POST["Seat_Number"]) &&
    isset($_POST["Price"]) 
) {
    if (
        !empty($_POST["flightNumber"]) &&
        !empty($_POST["UserName"]) &&
        !empty($_POST["Date_Purchase"])&&
        !empty($_POST["Seat_Number"]) &&
        !empty($_POST["Price"])
    ) {
        $Billet = new Billet(
            null,
            $_POST['flightNumber'],
            $_POST['UserName'],
            $_POST['Date_Purchase'],
            $_POST['Seat_Number'],
            $_POST['Price']
        );

        $BilletC->addBillet($Billet);
        header('Location:listBillet2.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Billet </title>
    
</head>
    
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Add this line to reset default margin */
        }

        #form-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Add the following styles to center the form within the bars.php template */
        .template-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
<div class="template-container"> <!-- Add this container div -->
    <div id="form-container">
        <form action="" method="POST">
        <table style="margin: 0 auto;">
            <tr>
                <td><label for="flightNumber">flight Number :</label></td>
                <td>
                    <input type="text" id="flightNumber" onkeyup="validerFn()" name="flightNumber" />
                    <span id="erreurflightNumber" style="color: red"></span>
                    <span id="succesflightNumber" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="UserName">User Name :</label></td>
                <td>
                    <input type="text" id="UserName" onkeyup="validerUs()" name="UserName" />
                    <span id="erreurUserName" style="color: red"></span>
                    <span id="succesUserName" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Date_Purchase">Purchase's Date :</label></td>
                <td>
                    <input type="date" id="Date_Purchase" name="Date_Purchase" />
                    <span id="erreurDate_Purchase" style="color: red"></span>
                    <span id="succesDate_Purchase" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Seat_Number">Seat Number :</label></td>
                <td>
                    <input type="text" id="Seat_Number" onkeyup="validerSeat_Number()" name="Seat_Number" />
                    <span id="erreurSeat_Number" style="color: red"></span>
                        <span id="succesSeat_Number" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Price">Price :</label></td>
                <td>
                    <input type="text" id="Price" onkeyup="validerPrice()" name="Price" />
                    <span id="erreurPrice" style="color: red"></span>
                    <span id="succesPrice" style="color: green"></span>
                </td>
            </tr>
            
            <td>
                <input type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
    </div>
</div>                           

    <script src="ControleSaisie_Billet.js"></script>
</body>
</html>