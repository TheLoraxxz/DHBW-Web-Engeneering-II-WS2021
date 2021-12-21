<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$auswahl= 0;
$user = $page->getSession();
$daten = $db->getStammdaten($user);


$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window">
            <h2>Stammdaten ändern</h2>
            <div>
                <label class="info_text">Name: '. $daten[0][3].'<br><span class="text-warning">kann nur einmal gesetzt werden!</span></label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDName.php" >Ändern</a>
                <br>
                <br>
            </div>
            <div>
                <label class="info_text">Nachname: '. $daten[0][4].'<br><span class="text-warning">kann nur einmal gesetzt werden!</span></label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDNachname.php" >Ändern</a>
                <br>
                <br>
            </div>
            <div>
                <label class="info_text">Login: '. $daten[0][0].'</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDLogin.php" >Ändern</a>
                <br>
                <br>
            <div>
                <label class="info_text">Email: '. $daten[0][1].' </label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDEmail.php">Ändern</a>
                <br>
                <br>
            </div>
                <label class="info_text">Passwort</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDPassword.php">Ändern</a>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();