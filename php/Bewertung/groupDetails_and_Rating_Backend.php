<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$daten=$db->getGroupRatingStuff($_POST["gruppeID"]);
//this looks whether the points for all are set if not then for every user the rating is set
if (isset($_POST["gPoints"]) and $_POST["gPoints"]!="") {
    if($daten[0][3] >= $_POST["gPoints"])
    {
        for ($z=0;$z<count($daten); $z++) {
            $db->updatePoints($_POST["gPoints"], $daten[$z][0]);
        }
    }
} else {
    $length=count($_POST)-1;
    for ($k=0;$k<$length;$k++) {
        if ($_POST["uPoints".$daten[$k][0]]!="") {
            if($daten[0][3] >= $_POST["uPoints"])
                $db->updatePoints($_POST["uPoints".$daten[$k][0]], $daten[$k][0]);
        }
    }
}
//after that you are beeing sent back to home.php
header("Location: ".Page::getRoot().'php/home.php');
