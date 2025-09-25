<?php
// Import necessary files and configurations
include 'C:\xampp\htdocs\login\controller\userC.php';

// Check if the 'id' parameter is set in the URL
if(isset($_GET["id"])) {
    // Create an instance of the userC controller
    $clientC = new userC();

    // Call the deleteuser method with the specified user ID
    $clientC->deleteuser($_GET["id"]);

    // Redirect to the user list page
    header('Location: listJusers.php');
    exit(); // Ensure script stops here
} else {
    // Handle the case when 'id' parameter is not set
    echo "User ID not provided.";
}
?>
