<?php
include_once('../../templates/Page.php');
include_once("../../templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

$table = new Table($db->getUserInvites($page->getSession()));
$table->addColumn("ID",0,false);
$table->addColumn("Name",1);
$table->addColumn("Date",2);
//if open to invite
$table->addColumn("",-1,true, '<button class="btn btn-secondary">Accept</button><button class="btn btn-secondary">Decline</button>');
$page->addElement($table);
$page->printPage();
