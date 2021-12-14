<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$db = $page->getDBService();
$user = $page->getSession();

$daten = $db->getStammdaten(1);
echo "aktuelle UserID: ".$user;
echo "EmailSeite";




$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="Stammdaten.php" method="post">
            <h2>Stammdaten ändern</h2>
            <div>
                <br>
                <input name="pw" placeholder="Neues Passwort">
                <input name="pwWdh" placeholder="Neues Passwort wiederholen">
                <br>
                <br>
                <button class="btn-sm btn-primary">Ändern</button>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();