<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if ($page->getRole() == 1) {

    /**
     *  Funktionaler Part zur Nutzererstellung.
     *  Die aus create_edit_user.php uebergebenen Werte werden in an zugehoerigen DBService.php Funktionen uebergeben.
     *  setUser und setUserCIR setzten die Erstellung in der Datenbank um.
     *  setUSer kuemmert sich um den Datensatz im table user.
     *  setUserCIR um die Zuweisung zu role, course und institution.
     *  Ist ein Institut/Kurs nicht vorhanden, werden sie in der Datenbank neu angelegt.
     */

    if (isset($_POST["user_id"])) {
        $userStatus = $db->setUser($_POST["user_id"], $_POST["login"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), $_POST["surename"], $_POST["name"]);
        $db->setUserCIR($_POST["user_id"], $_POST["institute"], $_POST["course_input"], $_POST["role"], $userStatus);
    }



    $string = '
        <div class="container-md mt-5" >
            <h2>Der User wurde erstellt!</h2>
             <div class="col-12 mt-3">
                <a href="./create_user.php?action=overview"><button class="btn btn-outline-secondary" href="createProject.php">Einen weiteren User erstellen</button></a>
                <a href = "../home.php"><button class="btn btn-outline-secondary">Startseite</button></a>
              </div>
        </div>
    ';

    $page->addHtml($string);
} else {
    $page->showError("Keinen Zugriff");
}
$page->printPage();
