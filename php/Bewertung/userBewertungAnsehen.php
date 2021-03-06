<?php
include_once("../templates/Page.php");
include_once("../templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
//can give you all the ratings of one user
if ($page->getRole()==2) {
    $table = new Table($db->getUserBewertungTable($page->getSession()));
    $table->addColumn("Projekt",2);
    $table->addColumn("Gruppe",1);
    $table->addColumn("Punkte",0);
    $table->addColumn("MaxPunkte",3);
    $page->addJs("tablebuttons_home.js");
    $page->addElement($table);
}
$page->addJs("tablebuttons_userBewertung.js");
$page->printPage();