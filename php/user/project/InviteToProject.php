<?php
include_once('../../templates/Page.php');
include_once("../../templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$table = new Table($db->getAllUsersInCourse($page->getSession(),1)); // get der Projekt id
$table->addColumn("id",0,false);
$table->addColumn("Name",1);
$table->addColumn("",-1,true, '<button class="btn btn-secondary" onclick="CreateInvite(this, 1);">Invite</button>');// get der Projekt id
$page->addElement($table);
$page->addJs("User/inviteToProject.js");
$page->printPage();
