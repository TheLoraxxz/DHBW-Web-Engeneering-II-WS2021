<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$auswahl= 0;
$user = $page->getSession();
$daten = $db->getStammdaten($user);


if (isset($_POST["name"])) {
    $auswahl=1;
    $stammdaten="'".$_POST["name"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    $_POST["name"]=NULL;
}
if (isset($_POST["email"])) {
    $auswahl=2;
    $stammdaten="'".$_POST["email"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    $_POST["email"]=NULL;
}
if ((isset($_POST["pw"]) and isset($_POST["pwWdh"]))) {
    if (($_POST["pw"]==$_POST["pwWdh"])) {
        $auswahl=3;
        $password =password_hash($_POST["pw"],PASSWORD_BCRYPT);
        $_POST["pw"]=NULL;
        $_POST["pwWdh"]=NULL;
        #$stammdaten="'".$_POST["pw"]."'";
        $db->stammdatenUpdate($password, $user, $auswahl);
        $db->verifyLogin($daten[0][0],$password);
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