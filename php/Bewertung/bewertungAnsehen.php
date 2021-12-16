<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

switch ($page->getRole()) {
    case 1:
        #Admin
        break;
    case 2:
        #User
        break;
    case 3:
        #Secretary
        break;
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window">
            <h2>Bewertung ansehen</h2>
            <div>
                <label class="info_text">Text</label>
                <br>
            </div>
            <div>
                <label class="info_text">Text</label>
                <br>
            </div>
            <div>
                <label class="info_text">Text</label>
                <br>
            <div>
                <label class="info_text">Text </label>
                <br>
            </div>
                <label class="info_text">Text</label>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();