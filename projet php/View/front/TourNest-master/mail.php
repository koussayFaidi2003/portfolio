<?php

// Inclure les fichiers de PHPMailer
require 'C:/xampp/htdocs/INTEG MALEK OUMA/View/back/Preclinic-Hospital-Bootstrap4-Admin/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/INTEG MALEK OUMA/View/back/Preclinic-Hospital-Bootstrap4-Admin/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/INTEG MALEK OUMA/View/back/Preclinic-Hospital-Bootstrap4-Admin/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Récupérer les données du commentaire impoli depuis l'URL
$nom = $_GET['nom'] ?? '';
$email = $_GET['email'] ?? '';
$commentaireFiltre = $_GET['commentaire'] ?? '';

// Envoyer un e-mail à l'administrateur avec les détails du commentaire impoli
function envoyerEmailAdmin($nom, $email, $commentaire) {
    $destinataire = "sana.essghir@gmail.com"; // Remplacez par l'adresse e-mail de l'administrateur
    $sujet = "Commentaire Impoli";

    $message = "Nom : $nom\n";
    $message .= "Email : $email\n";
    $message .= "Commentaire : $commentaire\n";

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP (Gmail dans cet exemple)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'essghir.malek@esprit.tn'; // Remplacez par votre adresse Gmail complète.
        $mail->Password   = 'Malekessghir22'; // Remplacez par le mot de passe de votre compte Gmail.
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire et expéditeur
        $mail->setFrom('essghir.malek@esprit.tn', 'Malek-essghir');
        $mail->addAddress($destinataire);

        // Contenu du message
        $mail->Subject = $sujet;
        $mail->Body    = $message;

        $mail->send();
        echo "E-mail envoyé avec succès à l'administrateur.";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
    }
}

// Envoyer l'e-mail à l'administrateur
envoyerEmailAdmin($nom, $email, $commentaireFiltre);

// Affichage d'un message (vous pouvez personnaliser cela selon vos besoins)
echo "Votre commentaire a été signalé comme impoli. Merci de votre vigilance.";

?>
