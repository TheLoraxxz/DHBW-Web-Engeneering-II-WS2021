<?php
include_once ("./templates/Page.php");
include_once ("./templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);

$db = $page->getDBService();



$page->printPage();
