<?php
include_once("./php/templates/DBService.php");
include_once ("./php/templates/Page.php");

$service = new DBService();
$page = new Page();
$page->setTitle("Notendatenbank");
$page->printPage();
?>
