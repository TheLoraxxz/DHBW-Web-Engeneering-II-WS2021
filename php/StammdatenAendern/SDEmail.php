<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();

if (isset($_POST["email"])) {
    if ($_POST["email"]!="") {
        $auswahl=2;
        $stammdaten="'".$_POST["email"]."'";
        $db->stammdatenUpdate($stammdaten, $user, $auswahl);
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    } else
        $page->showError("Feld muss gefüllt sein!");
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="SDEmail.php" method="post">
            <h2>Email ändern</h2>
            <div>
                <br>
                <input class="form-control" name="email" placeholder="Neue Email">
                <button class="btn-sm btn-primary">Speichern</button>
                <br>
                <br>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();