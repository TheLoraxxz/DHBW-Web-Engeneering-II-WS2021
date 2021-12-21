<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$daten=$db->getGroupRatingStuff();

if (isset($_POST["gPoints"]) and $_POST["gPoints"]!="") {
    for ($z=0;$z<count($daten); $z++) {
        $db->updatePoints($_POST["gPoints"], $daten[$z][0]);
    }
} else {
    $length=count($_POST)-1;
    for ($k=0;$k<$length;$k++) {
        if ($_POST["uPoints".$daten[$k][0]]!="") {
            $db->updatePoints($_POST["uPoints".$daten[$k][0]], $daten[$k][0]);
        }
    }
}
header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/Bewertung/groupDetails_and_Rating.php?action=done");