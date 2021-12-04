<?php
include_once ("./templates/Page.php");
include_once ("./templates/DBService.php");
include_once ("./templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);

$db = $page->getDBService();

switch ($page->getSession()) {
    case 1:
        var_dump("you are admin");
}
$page->printPage();
