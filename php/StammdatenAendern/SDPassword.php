<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="Stammdaten.php" method="post">
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