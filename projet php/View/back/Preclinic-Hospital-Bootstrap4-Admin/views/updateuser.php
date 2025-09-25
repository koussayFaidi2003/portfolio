<?php

include 'C:\xampp\htdocs\login\controller\userC.php';
include 'C:\xampp\htdocs\login\model\user.php';
$error = "";

// create client
$user = null;
// create an instance of the controller
$userC = new userC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["psw"]) &&
    isset($_POST["tel"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["psw"]) &&
        !empty($_POST["tel"])
        ) {
            foreach ($_POST as $key => $value) {
                echo "Key: $key, Value: $value<br>";
            }
            $user = new user(
                null,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['psw'],
                $_POST['tel']
            );
            var_dump($user);
            $userC->updateuser($user, $_POST['iduser']);

        header('Location:listusers.php');
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

<body>
    <button><a href="listusers.php">Back to list</a></button>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['iduser'])) {
        $user = $userC->showuser($_POST['iduser']);
        
    ?>
    <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="nom">Iduser :</label></td>
                    <td>
                        <input type="text" id="iduser" name="iduser" value="<?php echo $_POST['iduser'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $user['nom'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom'] ?>" />
                        <span id="erreurPrenom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?php echo $user['email'] ?>" />
                        <span id="erreurEmail" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                <td><label for="psw">Password :</label></td>
                <td>
                    <input type="password" id="psw" name="psw" />
                    <span id="erreurPassword" style="color: red"></span>
                </td>
            </tr>
                <tr>
                    <td><label for="telephone">Téléphone :</label></td>
                    <td>
                        <input type="text" id="telephone" name="tel" value="<?php echo $user['tel'] ?>" />
                        <span id="erreurTelephone" style="color: red"></span>
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
    <?php
    }
    ?>
</body>

</html>
    
