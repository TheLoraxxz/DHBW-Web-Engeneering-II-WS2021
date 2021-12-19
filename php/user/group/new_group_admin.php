<?php
include_once('../../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$html = '
<div class="container-fluid main">
    <div class="row">
    <div class="col-md-3">
';
//wenn es ein admin ist zeigt es noch die auswahl welches projekt man selektieren möchte
if ($page->getRole()==1) {
    $html = $html.'
        <div class="form-floating">
            <select class="form-select" id="projects_input">
                <option selected>-</option>';
    $projects = $db->getAllProjects();
    for ($i=0;$i<count($projects);++$i) {
        $html = $html.'<option onclick="sort()" value="'.$projects[$i]["project_id"].'">'.$projects[$i]["name"].'</option>';
    }
    $html = $html.'
            </select>
            <label class="form-label" >Project auswählen</label>
        </div>
    ';
}
if($page->getRole()!=3) {
    $html = $html.'
            <div>
                <label for="group_name" class="form-label">Name:</label>
                <input id="group_name" class="form-control">
            </div>
            <div>
                <label class="form-label" for="inventations">Teilnehmer</label>
                <div class="input-group">
                    <input class="form-control" id="inventations">
                    <button class="btn btn-outline-secondary" onclick="openList()">Invite</button>
                </div>
            </div>
    </div>
     <div class="col-md-3" style="display: none" id="listing">
            <h3>People to invite</h3>
            <div>
                <ul class="list-group list_of_people">';
    $users = $db->getAllSuitableUser($page->getRole(),$page->getSession());
    for ($i=0;$i<count($users);++$i) {
        if ($users[$i]["surename"] == null or $users[$i]["name"]==null) {
            $html = $html.'
         <li class="list-group-item">
            <div class="form-check">
                <input onclick="selectUser(this)" class="form-check-input" type="checkbox" id="name_'.$users[$i]["id"].'">
                <label class="form-check-label">'.$users[$i]["login"].'</label>
                <span style="display: none;">'.$users[$i]["project"].'</span>
            </div>
        </li>
    ';
        } else {
            $html = $html.'
         <li class="list-group-item">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="name_'.$users[$i]["id"].'">
                <label class="form-check-label">'.$users[$i]["surename"].' '.$users[$i]["name"].'</label>
                <span style="display: none;">'.$users[$i]["project"].'</span>
            </div>
        </li>
    ';
        }

    }

    $html = $html.'                </ul>
            </div>
        </div>
        <form style="display: none;" action="new_group_admin.php" method="post">
            <input type="text" id="course_id" name="course">
            <input type="text" id="name" name="group_name">
            <input type="text" id="member" name="member">
            
        </form>
    </div>
    ';

    $page->addJs("admin/create_group.js");
    $page->addCs("new_group.css");
    $page->addHtml($html);
} else {
    $page->showError("Keine Berechtigungen um Gruppen zu erstellen.");
}

$page->printPage();
