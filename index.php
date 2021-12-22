<?php
include_once ("./php/templates/Page.php");

$page = new Page();
$service = $page->getDBService();
//if it is logout it resets the cookie

if (isset($_GET["action"])) {
    setcookie("GradlappainCook", "", time() - 3600);
}

// if the post is login and the password is set
if ((isset($_POST["login"]) and isset($_POST["password"]))) {
    //if it is verified it redirects to home and if not it shows that the id is wrong
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

//if it is set it automatically redirects to home.php
if (isset($_COOKIE['GradlappainCook'])) {
    if($page->getLoginstatus($_COOKIE['GradlappainCook'])) {
        header('Location: ./php/home.php');
        die();
    }
}
//prints the form input
$page->addCs('login_and_home/login.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-sm"></div>   
        <form method="post" action="index.php" class="col-sm login_window">
            <img src="'.Page::getRoot().'assets/img/Logo_Background.svg" alt="Logo">
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

