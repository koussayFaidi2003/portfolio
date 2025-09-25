<?php
include 'C:/xampp/htdocs/tacheOffres/Controller/AvisC.php';
$AvisC = new AvisC();

// Check if the "id" parameter is set in the URL
if (isset($_GET["id"])) {
    // Get the offer ID from the URL
    $id = $_GET["id"];

    // Call the supprimeroffre method to delete the offer
    $AvisC->supprimeravis($id);

    // Redirect to the listOffres.php page
    header('Location: listavis.php');
} else {
    // Handle the case where the "id" parameter is not set
    echo "Donner un id de L'avis.";
}
?>