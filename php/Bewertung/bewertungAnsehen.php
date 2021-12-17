<?php
include_once("../templates/Page.php");
include_once("../templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

switch ($page->getRole()) {
    case 1:
        #admin
        $table = new Table();
        $table->addColumn("ID",0,false);
        $table->addColumn("Name",1);
        $table->addColumn("Projekt",2);
        $table->addColumn("Note",-1,true,'<button class="btn btn-secondary">See Details</button>');

        $page->addJs("tablebuttons_home.js");
        $page->addElement($table);
        break;
    case 2:
        #user
        $table = new Table();
        $table->addColumn("ID",0,false);
        $table->addColumn("Name",1);
        $table->addColumn("Projekt",2);
        $table->addColumn("Note",-1,true,'<button class="btn btn-secondary">See Details</button>');

        $page->addJs("tablebuttons_home.js");
        $page->addElement($table);
        break;
}
$page->printPage();