<?php
 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
 
//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {
 
  $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'tasnimabroukii@gmail.com';   //SMTP write your email
    $mail->Password   = 'nngbkggqzkbctrhd';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    
 
    // Recipients
    $senderEmail = 'tasnimabroukii@gmail.com';
    $mail->setFrom($senderEmail, $_POST["sender_email"]); // Sender Email and name
    $recipientEmail = $_POST["receiver_email"];
    
    // Ensure the recipient email is a Gmail address
    if (filter_var($recipientEmail, FILTER_VALIDATE_EMAIL) && strpos($recipientEmail, '@gmail.com') !== false) {
        $mail->addAddress($recipientEmail);        // Add a recipient email
    } else {
        // Handle the error as needed (invalid email address)
        echo "
        <script>
            alert('Invalid recipient email address. Please provide a valid Gmail address.');
            document.location.href = 'index.php';
        </script>
        ";
        exit; // Stop execution if the recipient email is invalid
    }

    $mail->addReplyTo($_POST["receiver_email"], $_POST["sender_email"]); // Reply to sender email
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message
      
    // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'index.php';
    </script>
    ";
}