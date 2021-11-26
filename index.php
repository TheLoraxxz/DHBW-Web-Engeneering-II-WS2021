<?php
include_once("./php/templates/DBService.php");
include_once ("./php/templates/Page.php");


$service = new DBService();
$page = new Page();
if (isset($_POST["login"]) and isset($_POST["password"]) and $service->verifyLogin($_POST["login"],$_POST["password"])) {
    $string = '<script>
        window.location = "./php/home.php";
        
    </script>';
    $page->addHtml($string);
    $page->printPage();
}
if(isset($_COOKIE['GradlappainCook'])&&$page->getLoginstatus($_COOKIE['GradlappainCook'])) {
        header("Location: ./php/home.php");
        die();
} else {
    $page->addCs('login_and_home/login.css');
    $string = '
    <div>
        <form method="post" action="index.php" class="container">
            <h1>Login</h1>
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
    </div>
    ';
    $page->addHtml($string);
}
$page->printPage();
?>
