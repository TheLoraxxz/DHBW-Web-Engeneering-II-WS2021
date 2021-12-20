<?php
include_once('../../templates/Page.php');
include_once("../../templates/Table.php");


$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if(!isset($_GET["Group_ID"]))
{
    $userId = $page->getSession();
    $table = new Table($db->getUserInvites($page->getSession()));
    $table->addColumn("ID",0,false);
    $table->addColumn("Name",1);
    $table->addColumn("Date",2);
    $table->addColumn("",-1,true, '<button class="btn btn-secondary", onclick="EndInvite(this,  true,'.$userId.')">Accept </button>
                               <button class="btn btn-secondary", onclick="EndInvite(this, false,'.$userId.')">Decline</button>');
    $page->addElement($table);
    try {
        $page->addJs("User/inviteToProject.js");
    } catch (Exception $e) {
    }
}
else
{
    if($_GET["accepted"])
    {
        $db->AddToGroup(userId, rowId);
    }
    else
    {
        $db->RemoveInvite(userId, rowId);
    }
    $table = new Table($db->getUserInvites($page->getSession()));
    $table->addButton("Zurück",Page::getRoot()."php/Home.php");
}
$page->printPage();
