<?php

include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Flight.php';
include 'bars.php';
$error = "";

// create reservation
$flight = null;
// create an instance of the controller
$flightC = new FlightC();


if (
    isset($_POST["lieuD"]) &&
    isset($_POST["lieuA"]) &&
    isset($_POST["dateD"])&&
    isset($_POST["dateA"]) &&
    isset($_POST["numberp"]) &&
    isset($_POST["billet"])
) {
    if (
        !empty($_POST["lieuD"]) &&
        !empty($_POST["lieuA"]) &&
        !empty($_POST["dateD"])&&
        !empty($_POST["dateA"]) &&
        !empty($_POST["numberp"]) &&
        !empty($_POST["billet"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $flight = new Flight(
            null,
            $_POST['lieuD'],
            $_POST['lieuA'],
            $_POST['dateD'],
            $_POST['dateA'],
            $_POST['numberp'],
            $_POST['billet']
        );
        var_dump($flight);
        
        $flightC->updateFlight2($flight, $_POST['idFlight']);

        header('Location:listFlight2.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>

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
	<div id="error">
        <?php echo $error; ?>
    </div>
    <?php					
    if (isset($_POST['idFlight'])) {
        $flight = $flightC->showFlight($_POST['idFlight']);
        
    ?>
	<div class="template-container"> <!-- Add this container div -->
    <div id="form-container">
        <form action="" method="POST">
        <table style="margin: 0 auto;">
                <tr>
                    <td><label for="idFlight">id Flight :</label></td>
                    <td>
                        <input type="hidden" id="idFlight" name="idFlight"  value="<?php echo $flight['idFlight']; ?>" />
                        <span id="erreuridFlight" style="color: red"></span>
                    </td>
                </tr>
            <tr>
                <td><label for="lieuD">Departure :</label></td>
                <td>
                    <input type="text" id="lieuD"  onkeyup="validld()" name="lieuD" value="<?php echo $flight['lieuD']?>"/>
                    <span id="erreurlieuD" style="color: red"></span>
                    <span id="succeslieuD" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="lieuA">Destiantion:</label></td>
                <td>
                <input type="text" id="lieuA"  onkeyup="validla()" name="lieuA"  value="<?php echo $flight['lieuA'] ?>"/>
                    <span id="erreurlieuA" style="color: red"></span>
                    <span id="succeslieuA" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateD">Start Date :</label></td>
                <td>
                    <input type="date" id="dateD" name="dateD" value="<?php echo $flight['dateD'] ?>"/>
                    <span id="erreurdateD" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateA">End Date :</label></td>
                <td>
                    <input type="date" id="dateA" name="dateA" value="<?php echo $flight['dateA'] ?>"/>
                    <span id="erreurdateF" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="numberp">Capacity :</label></td>
                <td>
                <input type="text" id="numberp" onkeyup="validerNumberp()" name="numberp" value="<?php echo $flight['numberp'] ?>"/>
                    <span id="erreurnumberp" style="color: red"></span>
                    <span id="succesnumberp" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="billet">Ticket :</label></td>
                <td>
                    <input type="text" id="billet" onkeyup="validerbillet()" name="billet" value="<?php echo $flight['billet'] ?>"/>
                    <span id="erreurbillet" style="color: red"></span>
                    <span id="succesbillet" style="color: green"></span>   
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
	<?php
    }
    ?>
    <script src="ControleSaisie_Flight.js"></script>
</body>

</html>