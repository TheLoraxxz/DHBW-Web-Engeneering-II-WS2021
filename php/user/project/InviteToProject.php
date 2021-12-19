<?php
include_once('../../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$table = new Table($db->getAllUsersInCourse($page->getSession()));
$table->addColumn("Name",1);
$table->addColumn("",-1,true, '<button class="btn btn-secondary">Invite</button>');
$page->addElement($table);
$page->printPage();
