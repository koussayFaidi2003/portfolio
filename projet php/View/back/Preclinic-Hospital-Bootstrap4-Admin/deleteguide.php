<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/GuideC.php';
$guideC = new GuideC();
$guideC->deleteguide($_GET["id"]);
header('Location:listguide.php');