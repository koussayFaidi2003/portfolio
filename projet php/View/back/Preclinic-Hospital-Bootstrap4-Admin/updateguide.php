<?php

include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/GuideC.php';
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Model/guide.php';
include 'bars.php';
$error = "";

// create client
$guide = null;
// create an instance of the controller
$guideC = new GuideC();


if (
    isset($_POST["specailite"]) 
) {
    if (
        !empty($_POST['specailite']) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $guide = new Guide(
            null,
            $_POST['specailite']
        );
        var_dump($guide);
        
        $guideC->updateguide($guide, $_POST['id']);

        header('Location:listguide.php');
    } else
        $error = "Missing information";
}



?>
    <a href="listguide.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
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
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .collapse navbar-collapse {
    background-color: #82cef8;
}

		.main-menu  .nav  li.active a,
		.main-menu  .nav  li a:hover,
		.main-menu .nav  li a:focus{
    	color: #24d26d;
    	background: color #82cef8;;
}
		/* Styles spécifiques pour la navbar avec la classe main-menu */
.main-menu {
    border: 1px solid #87CEFA;
	background-color: #87CEFA;
	/* Couleur de la bordure bleu ciel */
}
/* ... Autres styles ... */
    </style>
    <center>
    <button><a href="listguide.php">Back to list</a></button>
    <center>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $guide = $guideC->showguide($_POST['id']);
        
    ?>

        <form action="" method="POST">
            <table border=1>
            <tr>
                    <td><label for="id">Id :</label></td>
                    <td>
						<h1>id:</h1>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurid" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="specailite">specialite :</label></td>
                    <td>
						<h1>specailite:</h1>
                        <input type="text" id="specailite" name="specailite" value="<?php echo $guide['specailite'] ?>" />
                        <span id="erreurspecailite" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</body>

</html>