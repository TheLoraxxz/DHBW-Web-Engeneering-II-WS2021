<?php
include_once('../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

if ($_GET["action"]=="lock") {
    $db->lockGroupInventation($_GET["projectId"]);
    header('Location: '.Page::getRoot().'php/home.php');
}
