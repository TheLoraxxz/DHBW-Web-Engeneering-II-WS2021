<?php
include_once("./php/templates/DBService.php");
include_once ("./php/templates/Page.php");


$service = new DBService();
$page = new Page();
if($page->getLoginstatus($_COOKIE['GradlappainCook'])) {

} else {
    $string = '
    <div>
        <form method="post" class="container">
            <h1>Login</h1>
            <div>
                <label class="form-label">Login</label>
                <input placeholder="Max Mustermann" class="form-control" id="login" name="login">
            </div>
            <div>
                <label class="form-label" for="password">Passwort</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div>
                <button class="btn btn-primary">Login</button>
            </div>
         
        </form>
    </div>
    ';
    $page->addHtml($string);
}
$page->printPage();
?>
