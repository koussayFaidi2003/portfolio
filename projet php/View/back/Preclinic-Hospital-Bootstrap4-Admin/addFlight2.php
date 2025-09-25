<?php
// Importations bécessaires
include "C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php";
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/Flight.php';
include 'bars.php';
$error = "";

// create flight
$Flight = null;
// create an instance of the controller
$FlightC = new FlightC();

if (
    isset($_POST["lieuD"]) &&
    isset($_POST["lieuA"]) &&
    isset($_POST["dateD"])&&
    isset($_POST["dateA"]) &&
    isset($_POST["numberp"]) &&
    isset($_POST["billet"]) 
) {
	//var_dump($_POST);
    if (
        !empty($_POST["lieuD"]) &&
        !empty($_POST["lieuA"]) &&
        !empty($_POST["dateD"])&&
        !empty($_POST["dateA"]) &&
        !empty($_POST["numberp"]) &&
        !empty($_POST["billet"])  
    ) {
        $Flight = new Flight(
            null,
            $_POST['lieuD'],
            $_POST['lieuA'],
            $_POST['dateD'],
            $_POST['dateA'],
            $_POST['numberp'],
            $_POST['billet']
        );

        $FlightC->addFlight2($Flight);
        header('Location:listFlight2.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FLIGHT </title>
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
                    <td><label for="idFlight">id Flight :</label></td>
                    <td>
                        <input type="hidden" id="idFlight" name="idFlight"  />
                        <span id="erreuridFlight" style="color: red"></span>
                    </td>
                </tr>
            <tr>
                <td><label for="lieuD">Departure :</label></td>
                <td>
                    <input type="text" id="lieuD"  onkeyup="validld()" name="lieuD" />
                    <span id="erreurlieuD" style="color: red"></span>
                    <span id="succeslieuD" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="lieuA">Destiantion:</label></td>
                <td>
                <input type="text" id="lieuA"  onkeyup="validla()" name="lieuA" />
                    <span id="erreurlieuA" style="color: red"></span>
                    <span id="succeslieuA" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateD">Start Date :</label></td>
                <td>
                    <input type="date" id="dateD" name="dateD" />
                    <span id="erreurdateD" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateA">End Date :</label></td>
                <td>
                    <input type="date" id="dateA" name="dateA" />
                    <span id="erreurdateF" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="numberp">Capacity :</label></td>
                <td>
                <input type="text" id="numberp" onkeyup="validerNumberp()" name="numberp" />
                    <span id="erreurnumberp" style="color: red"></span>
                    <span id="succesnumberp" style="color: green"></span>
                </td>
            </tr>
            <tr>
                <td><label for="billet">Ticket :</label></td>
                <td>
                    <input type="text" id="billet" onkeyup="validerbillet()" name="billet" />
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
    <script>
            function validld(){
                var lieuD = document.getElementById("lieuD").value;
                var erreurlieuD = document.getElementById("erreurlieuD");
                var succeslieuD = document.getElementById("succeslieuD");
                if (!/^[A-Za-z]+$/.test(lieuD) || lieuD.length < 1) {
                    erreurlieuD.textContent = "lieuD invalide";
                    erreurlieuD.style.color = "red";
                    succeslieuD.textContent = ""; 
                } else {
                    erreurlieuD.textContent = " ";
                    succeslieuD.textContent = "lieuD valide";
                    succeslieuD.style.color = "green";
                }
            }
            function validla(){
                var lieuA = document.getElementById("lieuA").value;
                var erreurlieuA = document.getElementById("erreurlieuA");
                var succeslieuA = document.getElementById("succeslieuA");
                if (!/^[A-Za-z]+$/.test(lieuA) || lieuA.length < 1) {
                    erreurlieuA.textContent = "lieuA invalide";
                    erreurlieuA.style.color = "red";
                    succeslieuA.textContent = ""; 
                } else {
                    erreurlieuA.textContent = "";
                    succeslieuA.textContent = "lieuA valide";
                    succeslieuA.style.color = "green";
                }
            }

            function validerNumberp() {
                var numberp = document.getElementById("numberp").value;
                var erreurnumberp = document.getElementById("erreurnumberp");
                var succesnumberp = document.getElementById("succesnumberp");

                if (/^[1-9][0-9]?$/.test(numberp)){
                    erreurnumberp.textContent = "";
                    succesnumberp.textContent = "Number of persons valide";
                    succesnumberp.style.color = "green";
                } else {
                    erreurnumberp.textContent = "invalide";
                    erreurnumberp.style.color = "red";
                    succesnumberp.textContent = "";
                }
            }
            function validerbillet() {
                var billet = parseInt(document.getElementById("billet").value);
                var erreurbillet = document.getElementById("erreurbillet");
                var succesbillet = document.getElementById("succesbillet");

                if (!isNaN(billet) && billet >= 1 && billet <= 1000) {
                    erreurbillet.textContent = "";
                    succesbillet.textContent = "Ticket is valid";
                    succesbillet.style.color = "green";
                } else {
                    erreurbillet.textContent = "Invalid Ticket";
                    erreurbillet.style.color = "red";
                    succesbillet.textContent = "";
                }
            }
        </script> 
    </div>
</div> 
</body>
</html>
