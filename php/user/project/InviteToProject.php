<?php
include_once('../../templates/Page.php');
include_once("../../templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$userId = $_GET['userId'];
$table = new Table($db->getAllUsersInCourse($page->getSession(),$userId));
$table->addColumn("id",0,false);
$table->addColumn("Name",1);
$table->addColumn("",-1,true, '<button class="btn btn-secondary" onclick="CreateInvite(this,'.$userId.');">Invite</button>');
$page->addElement($table);
try {
    $page->addJs("User/inviteToProject.js");
} catch (Exception $e) {
}
$page->printPage();
