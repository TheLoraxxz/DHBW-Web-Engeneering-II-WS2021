<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if ($page->getRole()==1) {

    //übersetzung von der Variablen in tinyInt für die Datenbank.
    if($_POST["open_to_invite"] == "Ja") {
        $open_to_invite = 1;
    } else {
        $open_to_invite = 0;
    }

    //Wurden Werte übergeben wird hier das Projekt über setProjekt() in DBService.php in der Datenbank erstellt.
    if(isset($_POST["name"])) {
        $project = $db->setProjekt($_POST["points_reachable"], $_POST["path_to_matrix"], $_POST["submission_date"], $open_to_invite, $_POST["max_of_students"], $_POST["name"]);
        if(!$db->createClass_Project($project,$_POST["klasscourse"])) {
            $page->showError("Keinen Kurs gefunden");
            $page->addHtml('<div class="container-fluid main"><a class="btn btn-primary" href="createProject.php">Zurück</a></div>');
        }

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
} else {
    $page->showError("Keinen Zugriff");
}
$page->printPage();
