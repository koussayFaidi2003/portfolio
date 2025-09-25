<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/BilletC.php';
$billet = new BilletC();
$billet->deleteBillet($_GET["id"]);
header('Location:listBillet2.php');

?>