<?php
include_once("./templates/Page.php");
include_once("./templates/DBService.php");
include_once("./templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

switch ($page->getSession()) {
    case 1:
        $table = new Table($db->getAdminTable());
        $table->addColumn("Projekt",0);
        $table->addColumn("Submission Date",4);
        $page->addElement($table);
        break;
    case 2:
        break;
    case 3:
        break;
}
$page->printPage();
