<?php
require_once ('./../templates/Page.php');

$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();