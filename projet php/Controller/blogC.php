<?php

include "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";

class blogC
{

public function listblog()
{
$sql = "SELECT * FROM tblog";

$db = config::getConnexion();
try {
$liste = $db->query($sql);
return $liste;
} catch (Exception $e) {
die('Error:' . $e->getMessage());
}
}

function deleteblog($id)
{
$sql = "DELETE FROM tblog WHERE id = :id";
$db = config::getConnexion();
$req = $db->prepare($sql);
$req->bindValue(':id', $id);

try {
$req->execute();
} catch (Exception $e) {
die('Error:' . $e->getMessage());
}
}

function addblog($blog)
{
$sql = "INSERT INTO tblog (title, content) VALUES (:title, :content)";
$db = config::getConnexion();
try {
$query = $db->prepare($sql);
$query->execute([
'title' => $blog->getTitle(),
'content' => $blog->getContent(),
]);
} catch (Exception $e) {
echo 'Error: ' . $e->getMessage();
}
}

function showBlog($id)
{
$sql = "SELECT * FROM tblog WHERE id = $id";
$db = config::getConnexion();
try {
$query = $db->prepare($sql);
$query->execute();
$blog = $query->fetch();
return $blog;
} catch (Exception $e) {
die('Error: ' . $e->getMessage());
}
}

function updateBlog($blog, $id)
{
try {
$db = config::getConnexion();
$query = $db->prepare(
'UPDATE tblog SET
title = :title,
content = :content
WHERE id = :id'
);

$query->execute([
'id' => $id,
'title' => $blog->getTitle(),
'content' => $blog->getContent(),
]);

echo $query->rowCount() . " records UPDATED successfully <br>";
} catch (PDOException $e) {
$e->getMessage();
}
}
}