<?php

require "../config.php";

class CommentaireC
{

public function listcommentaire()
{
$sql = "SELECT * FROM commentaire";

$db = config::getConnexion();
try {
$liste = $db->query($sql);
return $liste;
} catch (Exception $e) {
die('Error:' . $e->getMessage());
}
}

function deletecommentaire($idC)
{
$sql = "DELETE FROM commentaire WHERE idC = :idC";
$db = config::getConnexion();
$req = $db->prepare($sql);
$req->bindValue(':idC', $idC);

try {
$req->execute();
} catch (Exception $e) {
die('Error:' . $e->getMessage());
}
}

function addcommentaire($commentaire1)
{
$sql = "INSERT INTO commentaire (commentaire, email) VALUES (:commentaire, :email)";
$db = config::getConnexion();
try {
$query = $db->prepare($sql);
$query->execute([
'commentaire' => $commentaire1->getCommentaire(),
'email' => $commentaire1->getemail(),
]);
} catch (Exception $e) {
echo 'Error: ' . $e->getMessage();
}
}

function showcommentaire($idC)
{
$sql = "SELECT * FROM commentaire WHERE idC = $idC";
$db = config::getConnexion();
try {
$query = $db->prepare($sql);
$query->execute();
$commentaire1 = $query->fetch();
return $commentaire1;
} catch (Exception $e) {
die('Error: ' . $e->getMessage());
}
}

function updateCommentaire($commentaire, $idC)
{
try {
$db = config::getConnexion();
$query = $db->prepare(
'UPDATE commentaire SET
commentaire = :commentaire,
email = :email
WHERE idC = :idC'
);

$query->execute([
'idC' => $idC,
'commentaire' => $commentaire->getCommentaire(),
'email' => $commentaire->getemail(),
]);

echo $query->rowCount() . " records UPDATED successfully <br>";
} catch (PDOException $e) {
$e->getMessage();
}
}
}
 function afficheCommentaire($id) {
    try {
        $pdo = config :: getConnexion();
       $query=$pdo->prepare("SELECT * FROM commentaire where blog= :id");
       $query->execute(['id' =>$id]);
       return $query->fetchAll();
    } catch (PDOException $e){
        echo $e->getMessage();
    }

    }
 
 function afficheblog() {
    try {
        $pdo = config :: getConnexion();
       $query=$pdo->prepare("SELECT * FROM tblog");
       $query->execute(); 
       return $query->fetchAll();
    } catch (PDOException $e){
        echo $e->getMessage();
    }

    }
 