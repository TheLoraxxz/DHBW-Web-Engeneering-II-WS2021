<?php
include_once('../../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$html = '<div class="container-fluid main">';
if ($page->getRole()==1) {
    
}
