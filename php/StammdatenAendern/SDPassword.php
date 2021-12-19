<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();
$daten = $db->getStammdaten($user);

if ((isset($_POST["pw"]) and isset($_POST["pwWdh"]))) {
    if (($_POST["pw"]==$_POST["pwWdh"])) {
        if ($_POST["pw"]=="") {
            $page->showError("Bitte etwas eingeben!");
            header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
        }
        $auswahl=3;
        $password = password_hash($_POST["pw"],PASSWORD_BCRYPT);
        $db->stammdatenUpdate($password, $user, $auswahl);
        $db->verifyLogin($daten[0][0],$_POST["pw"]);
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/index.php?action=logout");
    }
    else {
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
        $page->showError("Passwort und PasswortWDH müssen übereinstimmen!");
    }
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="SDPassword.php" method="post">
            <h2>Passwort ändern</h2>
            <div>
                <br>
                <input name="pw" placeholder="Neues Passwort">
                <input name="pwWdh" placeholder="Neues Passwort wiederholen">
                <br>
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