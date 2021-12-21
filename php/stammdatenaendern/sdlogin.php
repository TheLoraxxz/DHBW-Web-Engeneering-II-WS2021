<?php
/** Im Header wird eine neue Seite kreirt und die benötigten Informationen beschafft.*/
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();

/** Input wird auf Korrektheit überprüft und ggf. in die Datenbank geladen */
if (isset($_POST["login"])) {
    if ($_POST["login"]!="") {
        $auswahl=1;
        $stammdaten="'".$_POST["login"]."'";
        $besetzt=$db->stammdatenUpdate($stammdaten, $user, $auswahl);
        if ($besetzt)
            header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/stammdatenaendern/stammdaten.php?action=done");
        else
            $page->showError("Login besetzt!");
    } else
        $page->showError("Feld muss gefüllt sein!");
}

/** Frontend wird gebaut */
$page->addCs('stammdatenaenderncss/stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="sdlogin.php" method="post">
            <h2>Login ändern</h2>
            <div>
            <br>
                <input class="form-control" name="login" placeholder="Neuer Login">
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