<?php
include_once ("./php/templates/Page.php");


$page = new Page();
$service = $page->getDBService();

if (isset($_GET["action"])) {
    setcookie("GradlappainCook", "", time() - 3600);
}

if ((isset($_POST["login"]) and isset($_POST["password"]))) {
    if($service->verifyLogin($_POST["login"],$_POST["password"])) {
        $string = '<script>
        window.location = "./php/home.php";
        
        </script>';
        $page->addHtml($string);
        $page->printPage();
        exit();
    } else {
        $page->showError("Logindaten sind falsch");
    }
}
if (isset($_COOKIE['GradlappainCook'])) {
    if($page->getLoginstatus($_COOKIE['GradlappainCook'])) {
        header('Location: ./php/home.php');
        die();
    }
}

$page->addCs('login_and_home/login.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-sm"></div>   
        <form method="post" action="index.php" class="col-sm login_window">
            <img src="./assets/img/Logo_Background.svg">
            <h1>Gradlappain</h1>
            <div>
                <label class="form-label">Login</label>
                <input placeholder="Max Mustermann" class="form-control" id="login" name="login">
            </div>
            <div>
                <label class="form-label" for="password">Passwort</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="login_button">
                <button class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';

$page->addHtml($string);
$page->printPage();

