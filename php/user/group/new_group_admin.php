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
if ($page->getRole()==1) {
    $html = $html.'
        <div class="form-floating">
            <select class="form-select" id="projects">
                <option selected></option>';
    $projects = $db->getAllProjects();
    for ($i=0;$i<count($projects);++$i) {
        $html = $html.'<option value="'.$projects[$i]["project_id"].'">'.$projects[$i]["name"].'</option>';
    }
    $html = $html.'
            </select>
            <label class="form-label" for="projects">Kurs auswählen</label>
        </div>
    ';
}
$html = $html.'
            <div>
                <label for="group_name" class="form-label">Name:</label>
                <input id="group_name" class="form-control">
            </div>
            <div>
                <label class="form-label" for="inventations">Teilnehmer</label>
                <div class="input-group">
                    <input class="form-control" id="inventations">
                    <button class="btn btn-outline-secondary">Invite</button>
                </div>
            </div>
    </div>
     <div class="col-md-3">
            <h3>People to invite</h3>
            <div>
                <ul class="list-group">';
$role = $page->getRole();
$user_id = $page->getSession();
$users = $db->getAllSuitableUser($role,$user_id);
/**
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="name_1">
                            <label class="form-check-label" for="name_1">Tilmann lorenz</label>
                        </div>
                    </li>
m,.   
*/
$html = $html.'                </ul>
            </div>
        </div>
</div>
';


$page->addCs("new_group.css");
$page->addHtml($html);
$page->printPage();
