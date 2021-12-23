<?php
include_once('../../templates/Page.php');
include_once("../../templates/Table.php");


$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$userId = $page->getSession();
$table = new Table($db->getUserInvites($page->getSession()));

//base view
if(!isset($_GET["Group_ID"]))
{
    $table->addColumn("ID",0,false);
    $table->addColumn("Name",1);
    $table->addColumn("Date",2);
    $table->addColumn("",-1,true, '<button class="btn btn-secondary", onclick="EndInvite(this,  true,'.$userId.')">Accept </button>
                                   <button class="btn btn-secondary", onclick="EndInvite(this, false,'.$userId.')">Decline</button>');
}
//if an invite was processed
else
{
    $accepted = filter_var($_GET['accepted'], FILTER_VALIDATE_BOOLEAN);
    if($accepted)
    {
        $db->AddToGroup($_GET["user_id"], $_GET["Group_ID"]);
    }
    else
    {
        $db->RemoveInvite($_GET["user_id"], $_GET["Group_ID"]);
    }
    $table->addColumn("ID",0,false);
    $table->addColumn("Name",1,false);
    $table->addColumn("Date",2,false);
    $table->addButton("Zurück",page::getRoot()."we2/php/home.php");
}
try {
    $page->addJs("User/inviteToProject.js");
} catch (Exception $e) {
}
$page->addElement($table);
$page->printPage();
