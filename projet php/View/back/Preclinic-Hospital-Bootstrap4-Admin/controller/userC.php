<?php

require 'C:\xampp\htdocs\login\config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class UserC
{
    public function listUsers()
    {
        $sql = "SELECT * FROM user";

        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addUser($user)
    {
        $db = Config::getConnexion();

        try {
            // Adjust the SQL query based on your actual table structure
            $sql = "INSERT INTO user (nom, prenom, email, psw, tel) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

            // Bind parameters
            $stmt->bindParam(1, $user->getNom());
            $stmt->bindParam(2, $user->getPrenom());
            $stmt->bindParam(3, $user->getEmail());
            $stmt->bindParam(4, $user->getPsw());
            $stmt->bindParam(5, $user->getTel());

            // Execute the statement
            $stmt->execute();

            // You may want to handle the success case appropriately

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteUser($userId)
    {
        $db = Config::getConnexion();

        try {
            // Adjust the SQL query based on your actual table structure
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $db->prepare($sql);

            // Bind parameter
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();

            // You may want to handle the success case appropriately

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function resetPassword($email)
    {
        


require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer();

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;


$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "koussay.faidi07@gmail.com";
$mail->Password = "hvijluqlzwzjrfoc";

$mail->isHtml(true);

return $mail;
}

} 

?>