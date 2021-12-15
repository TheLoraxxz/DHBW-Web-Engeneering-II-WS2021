<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

$invite = isset($_Post["open_to_invite"]) ? $_Post["open_to_invite"] : "Nein";

if($invite == "Ja") {
    $invite = "1";
} else {
    $invite = "0";
}

if(isset($_POST["name"])) {
    $db->setProjekt($_POST["points_reachable"], $_POST["path_to_matrix"], $_POST["submission_date"], $invite, $_POST["max_of_students"], $_POST["name"]);
}

$string = '
    <div class="container-md mt-5" >
        <h2>Ihr Projekt wurde erstellt!</h2>
         <div class="col-12 mt-3">
            <a href="./createProject.php"><button class="btn btn-outline-secondary" href="createProject.php">Ein weiteres Projekt erstellen</button></a>
            <a href = "../home.php"><button class="btn btn-outline-secondary">Startseite</button></a>
          </div>
    </div>
';

$page->addHtml($string);
$page->printPage();
