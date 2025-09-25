<?php
include 'C:/xampp/htdocs/blog/Controller/commentaireC.php';

if (isset($_GET["idC"])) {
    $CommentaireC = new commentaireC(); // Assurez-vous que le nom de la classe est correct ici
    $CommentaireC->deleteCom($_GET["idC"]); // Assurez-vous que le nom de la méthode de suppression est correct ici
}

header('Location: listCom.php');
?>