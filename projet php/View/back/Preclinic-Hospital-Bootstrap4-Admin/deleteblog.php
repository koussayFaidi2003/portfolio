<?php
include 'C:/xampp/htdocs/blog/Controller/blogC.php';

if (isset($_GET["id"])) {
    $blogC = new BlogC();
    $blogC->deleteblog($_GET["id"]);
}

header('Location: listblog.php');
?>
