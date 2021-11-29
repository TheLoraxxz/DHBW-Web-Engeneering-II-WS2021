<?php
include_once ("./templates/Page.php");

$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$page->printPage();
