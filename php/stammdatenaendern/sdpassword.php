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
if ((isset($_POST["pw"]) and isset($_POST["pwWdh"])) and isset($_POST["pwdAlt"])) {
    if (($_POST["pw"]==$_POST["pwWdh"])) {
        if ($_POST["pw"]!="") {
            $pwAlt=$db->getPwAlt($user);
            $auswahl=3;
            $password = password_hash($_POST["pw"],PASSWORD_BCRYPT);
            $password="'".$password."'";
            if (password_verify($_POST["pwdAlt"], $pwAlt[0][0])) {
                $db->stammdatenUpdate($password, $user, $auswahl);
                $db->verifyLogin($daten[0][0],$_POST["pw"]);
                header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/index.php?action=logout");
            } else
                $page->showError("Falsches Altes Passwort!");
        } else
            $page->showError("Felder müssen gefüllt und gleich sein!");
    } else
        $page->showError("Felder müssen gefüllt und gleich sein!");
}

/** Frontend wird gebaut */
$page->addCs('stammdatenaenderncss/stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="sdpassword.php" method="post">
            <h2>Passwort ändern</h2>
            <div>
                <br>
                <input class="form-control" name="pw" placeholder="Neues Passwort">
                <input class="form-control" name="pwWdh" placeholder="Neues Passwort wiederholen">
                <br>
                <input class="form-control" name="pwdAlt" placeholder="Altes Passwort">
                <br>
                <button class="btn-sm btn-primary">Speichern</button>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();