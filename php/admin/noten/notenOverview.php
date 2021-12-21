<?php
include_once('./../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if ($page->getRole()==1) {
    $table = new Table($db->getGrades());
    $table->addColumn("Punkte","points");
} else {
    header('Location: '.$page::getRoot().'php/home.php');
    die();
}
