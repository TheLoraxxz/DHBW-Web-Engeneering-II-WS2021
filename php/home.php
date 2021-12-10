<?php
include_once("./templates/Page.php");
include_once("./templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
switch ($page->getRole()) {
    case 1:
        $table = new Table($db->getAdminHomeTable());
        $table->addColumn("ID",0,false);
        $table->addColumn("Projekt",1);
        $table->addColumn("Submission Date",5);
        $table->addColumn("Completed",4);
        $table->addColumn("Groups overall",3);
        $editButton = '<button class="btn btn-secondary" onclick="editProject(this);">Edit</button>';
        $table->addColumn("Edit Project",-1,true,$editButton);
        $table->addColumn("See",-1,true,'<button class="btn btn-info" onClick="seeDetails(this);">See Details</button>');
        $table->addColumn("Gruppeneinladung sperren",-1,true,'<button class="btn btn-dark" onClick="lockData(this);">Sperren</button>');

        $table->addButton("New Project","");
        $table->addButton("New Group","");
        $page->addElement($table);
        $page->addJs("tablebuttons_home.js");
        break;
    case 2:
        $table = new Table($db->getUserHomeTable($page->getSession()));
        $table->addColumn("ID",0,false);
        $table->addColumn("Name",1);
        $table->addColumn("Date",2);
        $table->addColumn("Details einsehen",-1,true,'<button class="btn btn-secondary">See Details</button>');
        $table->addColumn("Abgeben",-1,true,'<button class="btn btn-primary">Abgeben</button>');

        $page->addJs("tablebuttons_home.js");
        $page->addElement($table);
        break;
    case 3:
        $table = new Table($db->getSecretareHomeTable($page->getSession()));
        $table->addColumn("Name",1);
        $table->addColumn("Vorname",0);
        $table->addColumn("Punkte",3);
        $table->addColumn("Gesamtpunktzahl",5);
        $table->addColumn("Kurse",2);
        $table->addColumn("Abgabezeit",4);
        $table->addButton("Noten ausdrucken","./pdf/print_pdf.php?soruce=home");
        $page->addElement($table);
        break;
}
$page->printPage();

