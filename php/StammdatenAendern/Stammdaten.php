<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$db = $page->getDBService();
$auswahl= 0;
$user = $page->getSession();
$daten = $db->getStammdaten(1);
echo "aktuelle UserID: ".$user;


if (isset($_POST["name"])) {
    echo "<br>".$_POST["name"];
    $auswahl=1;
    $stammdaten="'".$_POST["name"]."'";
    $db->stammdatenUpdate($stammdaten, 1, $auswahl);
}
if (isset($_POST["email"])) {
    echo "<br>".$_POST["email"];
    $auswahl=2;
    $stammdaten="'".$_POST["email"]."'";
    $db->stammdatenUpdate($stammdaten, 1, $auswahl);
}
if ((isset($_POST["pw"]) and isset($_POST["pwWdh"]))) {
    if (($_POST["pw"]==$_POST["pwWdh"])) {
        echo "<br>".$_POST["pw"];
        $auswahl=3;
        $stammdaten="'".$_POST["pw"]."'";
        $db->stammdatenUpdate($stammdaten, 1, $auswahl);
    }
    else
        #echo "pw and pwWdh must match";
        echo '<script>alert("pw and pwWdh must match")</script>';
}



$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window">
            <h2>Stammdaten ändern</h2>
            <div>
                <label class="info_text">Name: '. $daten[0][0].'</label>
                <br>
                <a class="btn-sm btn-primary text-decoration-none" href="SDLogin.php" >Ändern</a>
                <br>
                <br>
            <div>
                <label class="info_text">Email: '. $daten[0][1].' </label>
                <br>
                <a class="btn-sm btn-primary text-decoration-none" href="SDEmail.php">Ändern</a>
                <br>
                <br>
            </div>
                <label class="info_text">Passwort: <br>'. $daten[0][2].'</label>
                <br>
                <a class="btn-sm btn-primary text-decoration-none" href="SDPassword.php">Ändern</a>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();