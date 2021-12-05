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
        $table->addColumn("ID",0);
        $table->addColumn("Projekt",1);
        $table->addColumn("Submission Date",5);
        $editButton = '<button class="btn btn-secondary">Edit</button>';
        $table->addColumn("Status",-1,$editButton);

        $table->addColumn("See",-1,'<button class="btn btn-info" onClick="seeDetails(this);">See Details</button>');
        $page->addElement($table);
        $page->addJs("tablebuttons.js");
        break;
    case 2:
        break;
    case 3:
        break;
}
$page->printPage();
