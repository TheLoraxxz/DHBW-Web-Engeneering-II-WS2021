<?php
include_once("./templates/Page.php");
include_once("./templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

//get the role
switch ($page->getRole()) {
    //if the user is an admin
    case 1:
        $table = new Table($db->getAdminHomeTable());
        //add Data from SQL
        $table->addColumn("ID",0,false);
        $table->addColumn("Projekt",1);
        $table->addColumn("Eingabe Datum",5);
        $table->addColumn("Gruppen Abgegeben",4);
        $table->addColumn("Gruppen insgesamt",3);
        //buttons that each column so you can edit the porject or lock the group
        $editButton = '<button class="btn btn-secondary" onclick="editProject(this);">Edit</button>';
        $table->addColumn("Ansehen",-1,true,'<button class="btn btn-info" onClick="seeDetails(this);">See Details</button>');
        $table->addColumn("Gruppeneinladung sperren",-1,true,'<button class="btn btn-dark" onClick="lockData(this);">Sperren</button>');
        //button that links to group or project
        $table->addButton("Neues Projekt","./project/createProject.php");
        $table->addButton("Neue Gruppe","./user/group/new_group_admin.php");
        $table->addColumn("Projekt löschen",-1,true,'<button class="btn btn-dark" onClick="deleteProject(this);">löschen</button>');
        if(isset($_GET["ProjectId"]))
        {
            $db->DeleteProject($_GET["ProjectId"]);
            header('Refresh: 0; url=home.php');
        }
        $page->addElement($table);
        $page->addJs("tablebuttons_home.js");
        if (isset($_GET["success"]) and $_GET["success"]=="newGroup")
            $page->showSuccess("Neue Gruppe wurde erfolgreich eingefügt");
        break;
    //if it is a user
    case 2:
        $table = new Table($db->getUserHomeTable($page->getSession()));
        //add data  and add ID / name  / Date where you have to submit
        $table->addButton("Neue Gruppe","../php/user/group/new_group_admin.php");
        $table->addColumn("ID",0,false);
        $table->addColumn("Name",1);
        $table->addColumn("Date",2);
        //you can see your own details. Abgeben is to submiut the project
        $table->addColumn("Abgeben",-1,true,'<button class="btn btn-primary" onclick="SubmitProject(this);">Abgeben</button>');
        //if open to invite
        $table->addColumn("Einladen",-1,true,'<button class="btn btn-secondary" onclick="changeViewToInvite(this);">Edit</button>');// '<button class="btn btn-secondary" oncklick="changeViewToInvite(this);">Einladen</button>');//invite other Students to a Project

        if($db->getUserInvites($page->getSession()) != null)// Einladung vorhanden
        {
            $table->addButton("Einladungen",Page::getRoot()."we2/php/user/project/AcceptInvite.php");
        }
        if(isset($_GET["ProjektId"]))
        {
            date_default_timezone_set("CET");
            $db->SubmitGroupProject($page->getSession(),$_GET["ProjektId"],date('Y-m-d h:m:s'));
        }
        $page->addJs("tablebuttons_home.js");
        $page->addElement($table);
        break;
    //secretary part
    case 3:
        //if you press on noten ausdreucken and you have no data to print this is shown
        if (isset($_GET["error"]) and $_GET["error"]=="noData") {
            $page->showError("Keine Daten zum ausdrucken verfügbar");
        }
        $table = new Table($db->getSecretareHomeTable($page->getSession()));
        //add trhe name and surename points anjd basically the note /
        $table->addColumn("Name",1);
        $table->addColumn("Vorname",0);
        $table->addColumn("Punkte",3);
        $table->addColumn("Gesamtpunktzahl",5);
        $table->addColumn("Kurse",2);
        $table->addColumn("Abgabezeit",4);
        $table->addButton("Noten ausdrucken","./pdf/print_pdf.php?source=home");
        $page->addElement($table);
        break;
}
$page->printPage();
