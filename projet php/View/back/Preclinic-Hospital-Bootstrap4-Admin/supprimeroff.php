<?php
include 'C:/xampp/htdocs/tacheOffres/Controller/OffresC.php';
$offresC = new OffresC();

// Check if the "id" parameter is set in the URL
if (isset($_GET["id"])) {
    // Get the offer ID from the URL
    $id = $_GET["id"];

    // Call the supprimeroffre method to delete the offer
    $offresC->supprimerOffre($id);

    // Redirect to the listOffres.php page
    header('Location: listoff.php');
} else {
    // Handle the case where the "id" parameter is not set
    echo "Invalid request. Please provide an offer ID.";
}
?>