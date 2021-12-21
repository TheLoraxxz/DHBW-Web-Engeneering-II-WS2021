<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();
$daten = $db->getStammdaten($user);

if (isset($_POST["nachname"]) and $daten[0][4]==NULL) {
    if ($_POST["nachname"]!="") {
        $auswahl=5;
        $stammdaten="'".$_POST["nachname"]."'";
        $db->stammdatenUpdate($stammdaten, $user, $auswahl);
        header("Location: ".Page::getRoot()."php/StammdatenAendern/Stammdaten.php?action=done");
        $page->showSuccess("Nachname geändert");
    } else
        $page->showError("Feld muss gefüllt sein!");
}elseif (isset($_POST["nachname"]) and !($daten[0][4]==NULL)) {
    header("Location: ".Page::getRoot()."php/StammdatenAendern/Stammdaten.php?action=done");
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="SDNachname.php" method="post">
            <h2>Nachname ändern</h2>
            <div>
            <br>
                <input class="form-control" name="nachname" placeholder="Neuer Nachname">
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
