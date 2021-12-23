<?php
include_once('./../templates/Page.php');
include_once ('../templates/Table.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if($page->getRole()==1) {
    $data = $db->getAllProjectsDetails($_GET["project_id"]);
    $table = new Table($data);
    if (count($data)>0) {
        $table->addTableHeading("Projekt: ".$data[0]["project"]);
    } else {
        //if there is no data (no groups) the name and the class is stil lshown
        $data = $db->getProjectInfos($_GET["project_id"]);
        $table->addTableHeading("Projekt: ".$data[0]["project"]);
        $html = '<div class="container-fluid">
            <p>Klasse: '.$data[0]["class"].'</p>
        </div>';
        $page->addHtml($html);
    }
    //gets the groupnames and everything
    $table->addColumn("ID","id",false);
    $table->addColumn("Gruppenname","groupname");
    $table->addColumn("Abgegeben?","submitted");
    $table->addColumn("Zeit","submitted_time");
    $table->addColumn("Gruppenmitglieder","number");
    $seeDetailsGroup = '
        <button onclick="grade(this)" class="btn btn-primary">Bewerten</button>
    ';
    //all buttons are created
    $table->addColumn("",-1,true,$seeDetailsGroup);
    $table->addButton("Zurück","./../home.php");
    $page->addElement($table);

    $page->addJs("admin/project_overview.js");
}
$page->printPage();
