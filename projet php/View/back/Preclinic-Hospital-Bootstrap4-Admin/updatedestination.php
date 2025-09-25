<?php

include "C:/xampp/htdocs/INTEG MALEK OUMA/Controller/destinationC.php";
include 'C:/xampp/htdocs/INTEG MALEK OUMA//Model/destination.php';
include 'bars.php';
$error = "";

$destination = null;
$destinationC = new DestinationC();

if (isset($_POST["ville"]) && isset($_POST["pays"])) {
    if (!empty($_POST['ville']) && !empty($_POST["pays"])) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        if (isset($_POST["id"])) {
            $destination = new Destination(
                null,
                $_POST['pays'],
                $_POST['ville']
            );
            var_dump($destination);

            $destinationC->updatedestination($destination, $_POST['id']);

            header('Location: listdistination.php');
        } else {
            $error = "Missing information";
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #form-container {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 300px;
            margin-top: 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        #error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div id="form-container">
        <center>
            <h1>Update destination</h1>
        </center>
    </div>
        <form action="" method="POST" onsubmit="return validateForm();">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Update destination</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="pays">Pays :</label>
                                </div>
                                <div class="form-group">
                                    <input id="pays" name="pays" type="text" value="<?php echo isset($destination['pays']) ? $destination['pays'] : ''; ?>">
                                    <span class="error-message" id="erreurpays" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="ville">Ville:</label>
                                </div>
                                <div class="form-group">
                                    <input id="ville" name="ville" type="text" value="<?php echo isset($destination['ville']) ? $destination['ville'] : ''; ?>">
                                    <span class="error-message" id="erreurville" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="m-t-20 text-center">
                            <button input type="submit" class="btn btn-primary submit-btn">Update destination</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</form>
    </div>

    <div id="error">
        <?php echo $error; ?>
    </div>

</body>

</html>