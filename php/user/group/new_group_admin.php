<?php
include_once('../../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if (isset($_POST) and count($_POST)>0) {
    if ($page->getRole()==1) {
        $db->createGroup($_POST["course"],$_POST["group_name"],json_decode($_POST["member"]));
    } else {
        $db->createGroup($_POST["course"],$_POST["group_name"],json_decode($_POST["member"]),$page->getSession(),false);
    }
    header('Location: '.$page::getRoot().'php/home.php?success=newGroup');
    die();
}

$html = '
<div class="container-fluid main">
    <div class="row">
    <div class="col-md-3">
';
//wenn es ein admin ist zeigt es noch die auswahl welches projekt man selektieren möchte
if($page->getRole()!=3) {
    $html = $html.'
        <div class="form-floating">
            <select class="form-select" id="projects_input">
                <option selected>-</option>';
    if ($page->getRole()==1) {
        $projects = $db->getAllProjects();
    } else {
        $projects = $db->getAllProjects($page->getSession());
        if (count($projects)==0) {
            $page->showSuccess("Keine Gruppen zu erstellen!");
            $page->addHtml('<div class="container-fluid main"><button onclick="goBack()" class="btn btn-primary">Zurück</button></div>');
            $page->addJs("admin/create_group.js");
            $page->printPage();
            exit();
        }
    }

    for ($i=0;$i<count($projects);++$i) {
        $html = $html.'
        <option onclick="sort()" value="'.$projects[$i]["project_id"].'|'.$projects[$i]["max"].'">'.$projects[$i]["name"].'</option>';

    }
    $html = $html.'
            </select>
            <label class="form-label" >Project auswählen</label>
        </div>
            <div>
                <label for="group_name" class="form-label">Name:</label>
                <input id="group_name" class="form-control">
            </div>
            <div>
                <label class="form-label" for="inventations">Teilnehmer</label>
                <div class="input-group">
                    <input class="form-control" id="inventations" disabled>
                    <button class="btn btn-outline-secondary" onclick="openList()">Invite</button>
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" onclick="submitForm()">Einreichen</button>
                    <button class="btn btn-secondary" onclick="goBack()">Zurück</button>
                </div>
            </div>
    </div>
     <div class="col-md-3" style="display: none" id="listing">
            <h3>People to invite</h3>
            <div>
                <ul class="list-group list_of_people">';
    $users = $db->getAllSuitableUser($page->getRole(),$page->getSession());
    //für jeden user wird ein user hinzu gefügt und dann wird dazu ein projekt hinzugefügt- Dadurch kann man das alles auswählen
    for ($i=0;$i<count($users);$i++) {
        if ($users[$i]["surename"] == null or $users[$i]["name"]==null) {
            $html = $html.'
         <li class="list-group-item">
            <div class="form-check">
                <input onclick="selectUser(this)" class="form-check-input" type="checkbox" id="name_'.$users[$i]["id"].'">
                <label class="form-check-label">'.$users[$i]["login"].'</label>
                <span style="display: none;">'.$db->getProjectsToUSer($users[$i]["id"]).'</span>
            </div>
        </li>';
        } else if ($users[$i]["surename"] != null or $users[$i]["name"]!=null){
            $html = $html.'
         <li class="list-group-item">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="name_'.$users[$i]["id"].'">
                <label class="form-check-label">'.$users[$i]["surename"].' '.$users[$i]["name"].'</label>
                <span style="display: none;">'.$db->getProjectsToUSer($users[$i]["id"]).'</span>
            </div>
        </li>';
        }

    }
    //shadowform für das abschicken hinzufügen

    $html = $html.'                </ul>
            </div>
        </div>
        <form style="display: none;" action="new_group_admin.php" method="post" id="submitform">
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
