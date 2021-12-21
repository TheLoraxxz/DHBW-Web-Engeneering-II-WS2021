<?php
/** Im Header wird eine neue Seite kreirt und die benötigten Informationen beschafft.*/
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();
$daten = $db->getStammdaten($user);

/** Input wird auf Korrektheit überprüft und ggf. in die Datenbank geladen */
if (isset($_POST["name"]) and $daten[0][3]==NULL) {
    if ($_POST["name"]!="") {
        $auswahl=4;
        $stammdaten="'".$_POST["name"]."'";
        $db->stammdatenUpdate($stammdaten, $user, $auswahl);
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/stammdatenaendern/stammdaten.php?action=done");
    } else
        $page->showError("Feld muss gefült sein!");
}elseif (isset($_POST["name"]) and !($daten[0][3]==NULL)) {
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/stammdatenaendern/stammdaten.php?action=done");
}

/** Frontend wird gebaut */
$page->addCs('stammdatenaenderncss/stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="sdname.php" method="post">
            <h2>Name ändern</h2>
            <div>
            <br>
                <input class="form-control" name="name" placeholder="Neuer Name">
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