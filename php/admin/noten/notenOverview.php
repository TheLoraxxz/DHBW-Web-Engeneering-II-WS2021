<?php
include_once('./../../templates/Page.php');
include_once ('./../../templates/Table.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if ($page->getRole()==1) {
    $table = new Table($db->getGrades());
    $table->addColumn("Punkte","points");
    $table->addColumn("Nachname","name");
    $table->addColumn("Vorname","surename");
    $table->addColumn("Projekt","project");
    $table->addButton("Zurück","../../home.php");
    $page->addElement($table);
    $page->printPage();
} else {
    header('Location: '.$page::getRoot().'php/home.php');
    die();
}
