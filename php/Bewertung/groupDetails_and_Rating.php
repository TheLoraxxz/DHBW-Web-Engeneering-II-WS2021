<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$daten=$db->getGroupRatingStuff($_GET["disGruppe"]);
$html="";
$i=0;

if (empty($daten)) {
    $page->showError("keine User in dieser Gruppe!");
}

foreach ($daten as $value) {
    $name="uPoints".$daten[$i][0];
    $html=$html.'<div class="input-group felder"><span class="input-group-text">'. $daten[$i][1].'</span><input value="'.$daten[$i][2].'" type="number" class="form-control" name="'.$name.'" placeholder="Punkte"></div>';
    $i++;
}

$page->addCs('Bewertung/bewertung.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="groupDetails_and_Rating_Backend.php" method="post">
            <h2>Gruppen Details</h2>
            <div>
                <input type="number" class="form-control" name="gPoints" placeholder="Punkte für Alle vergeben">
            </div>
            '.$html.'
            <br>
            <input style="display: none" type="hidden" name="gruppeID" value="'.$_GET["disGruppe"].'">
            <button class="btn-sm btn-primary">Speichern</button>
            <a type="button" class="btn-sm btn-primary" href="../home.php">Zurück</a>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();
