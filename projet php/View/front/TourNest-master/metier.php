<?php
function isCommentaireImpoli($commentaire, $dictionnaire) {
    foreach ($dictionnaire as $motInterdit) {
        if (stripos($commentaire, $motInterdit) !== false) {
            return true;
        }
    }
    return false;
}

function filterCommentaire($commentaire, $dictionnaire) {
    foreach ($dictionnaire as $motInterdit) {
        $replacement = str_repeat('*', strlen($motInterdit));
        $commentaire = str_ireplace($motInterdit, $replacement, $commentaire);
    }
    return $commentaire;
}

$nom = $_POST['Name'] ?? '';
$email = $_POST['Email'] ?? '';
$commentaireClient = $_POST['Comments'] ?? '';

// Personnalisez votre dictionnaire impoli
$dictionnaireImpoli = array("insulte1", "insulte2", "mot_interdit", "vulgaire", "inapproprie");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isCommentaireImpoli($commentaireClient, $dictionnaireImpoli)) {
        $commentaireFiltre = "Le commentaire contient des termes impolis. Veuillez le modifier.";
        $commentaireFiltre = filterCommentaire($commentaireFiltre, $dictionnaireImpoli);

        // Affichage du message en rouge et du lien pour revenir
        echo '<span style="color: red;">' . $commentaireFiltre . '</span><br>';
        echo '<a href="blog-details.html">Back to the comment</a>';
        // Redirection vers la page "mail.php" avec les détails du commentaire impoli
        header("Location: mail.php?nom=$nom&email=$email&commentaire=$commentaireFiltre");
        exit();
    } else {
        // Traitement normal du commentaire ici
        echo "Commentaire valide";
    }
} else {
    // Redirection vers la page principale si la requête n'est pas POST
    header("Location:main.php");
    exit();
}
?>
