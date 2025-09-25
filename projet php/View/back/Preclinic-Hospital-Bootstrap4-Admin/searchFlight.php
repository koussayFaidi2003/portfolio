<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/BilletC.php';
include 'bars.php';
$error = "";

// create an instance of the controller
$BilletC = new BilletC();
//traitement d'un formulaire
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['billet'])&& isset($_POST['search']))
    {
        $idBillet=$_POST['billet'];
        $list = $BilletC->afficherFlights($idBillet);
    }
}
$billets =$BilletC->afficherBillets();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Flights' Search </title>
    
</head>
    
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Add this line to reset default margin */
        }

        #form-container {
    width: 50%;
    margin: -400px auto 0; /* Set margin-top to a negative value to move it to the very top */
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

        #wrapper {
    width: 50%;
    margin: -500px auto; /* Adjust the margin-top value as needed */
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
    <div class="template-container"> <!-- Add this container div -->
    <div id="form-container">
        <form action="" method="POST">
            <label for="billet" > Select a ticket : </label>
            <select name="billet" id="billet">
                <?php
                foreach($billets as $billet){
                    echo '<option value="' .$billet['idBillet'] .'">' .$billet['flightNumber'].'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Search" name="search">
        </form>
        
        </div>
</div> 
<div id="wrapper">
         <?php if (isset ($list) && is_array($list)):?>
            <br>
            <h2> Flights correspondants to Ticket selected : </h2>
            <ul>
            <?php foreach ($list as $flight): ?>
            <li>
                id Flight: <?= $flight['idFlight'] ?> <br>
                Departure: <?= $flight['lieuD'] ?> <br>
                Destination: <?= $flight['lieuA'] ?> <br>
                Start Date	: <?= $flight['dateD'] ?> <br> 
                End Date: <?= $flight['dateA'] ?> <br>
                Capacity: <?= $flight['numberp'] ?> 
            </li>
            <?php endforeach; ?>
            </ul>
            <?php else: ?>
    <p>No Flight correspondant found</p>
    <?php endif; ?>
    </div> 
    <script src="ControleSaisie_Billet.js"></script>
</body>
</html>