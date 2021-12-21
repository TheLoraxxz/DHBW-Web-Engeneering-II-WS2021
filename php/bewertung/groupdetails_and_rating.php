<?php
/** Im Header wird eine neue Seite kreirt und die benötigten Informationen beschafft.*/
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$daten=$db->getGroupRatingStuff($_GET["disGruppe"]);
$html="";
$i=0;

/** Fehlernachricht, falls keine User in der Gruppe sind die bewertet werden soll */
if (empty($daten)) {
    $page->showError("keine User in dieser Gruppe!");
}

/** Dynamische Anzahl Inputs je nach UserAnzahl*/
foreach ($daten as $value) {
    $name="uPoints".$daten[$i][0];
    $html=$html.'<div class="input-group felder"><span class="input-group-text">'. $daten[$i][1].'</span><input value="'.$daten[$i][2].'" type="number" class="form-control" name="'.$name.'" placeholder="Punkte"></div>';
    $i++;
}

/** Frontend wird gebaut */
$page->addCs('bewertung/bewertung.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="groupdetails_and_rating_backend.php" method="post">
            <h2>Gruppen Details</h2>
            <div>
                <input type="number" class="form-control" name="gPoints" placeholder="Punkte für Alle vergeben">
            </div>
            ' .$html.'
            <br>
                <input type="hidden" name="gruppeID" value="'.$_GET["disGruppe"].'">
            <button class="btn-sm btn-primary">Speichern</button>
            <button type="button" class="btn-sm btn-primary" href="">Zurück</button>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();