<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include "bars.php";
// Initialisez la variable $msg
$msg = '';
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Créez une instance PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'latifabenyahia1230@gmail.com';
        $mail->Password   = 'ecgpjcduzdudhtcg'; // Utilisez le mot de passe d'application généré
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Paramètres du courrier
        $mail->setFrom('latifabenyahia1230@gmail.com', 'Latifa ben yahia');
        $mail->addAddress('latifabenyahia1230@gmail.com', 'Latifa');
        $mail->addReplyTo('omayatestouri21@gmail.com', 'Omaya Testouri');

        // Contenu du courrier
        $mail->isHTML(false);
        $mail->Subject = 'Formulaire de contact PHPMailer';
        $mail->Body    = "E-mail: {$_POST['email']}\nNom: {$_POST['name']}\nMessage: {$_POST['message']}";
        
        // Envoyer le courrier électronique
        $mail->send();
        $msg = 'Message envoyé ! Merci de nous avoir contactés.';
    } catch (Exception $e) {
        $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
<style>
      body {
        background-color: lightblue;
    }

    form {
        margin-left: 300px;   /* Marge de 20 pixels à gauche */
        margin-right: 10px;  
        margin-top: 100px;   /* Marge de 20 pixels à gauche */
        margin-bottom: 80px; 
        width: 50%;
        border: 1px solid black;
        padding: 20px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        border: 1px solid black;
        padding: 5px;
        width: 100%;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulaire de contact</title>
</head>
<body>

<!-- Ajoutez jQuery (assurez-vous de l'inclure correctement dans votre projet) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Ajoutez votre propre script -->
<script>
    $(document).ready(function () {
        // Ajoutez un gestionnaire de clic pour l'icône de messagerie
        $('#messagesDropdown').on('click', function () {
            // Redirigez vers votre page PHP
            window.location.href = 'testphpmailer.php';
        });
    });
</script>
<?php if (!empty($msg)) {
    echo "<h2>$msg</h2>";
} ?>
<form method="POST">
<center><h1>Formulaire de contact</h1><center>
    <label for="name">Nom: <input type="text" name="name" id="name"></label><br><br>
    <label for="email">E-mail: <input type="email" name="email" id="email"></label><br><br>   
    <label for="message">Message: <textarea name="message" id="message" rows="8" cols="20"></textarea></label><br><br>
    <input type="submit" value="Envoyer">
</form>
</body>
</html>
