<?php
require_once ('./../templates/Page.php');

$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if(!isset($_POST["action"])) {
    $html = '
    <div class="container-fluid main row">
        <form class="mb-3 col-3" action="create_user.php" method="post">
            <input name="action" type="text" style="display: none" value="create">
            <div class="mb-3">
                <label class="mb-1 form-label" for="number_of_accounts_input">Anzahl der zu kreeierenden Accounts</label>
                <input type="number" class="form-control" name="number_of_accounts" id="number_of_accounts_input">
            </div>
            <div class="mb-3">
                <label class="mb-1 form-label" for="course_input">
                    Kurs
                </label>
                <input id="course_input" name="course" type="text" class="form-control">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
        
    </div>
    ';
    $page->addCs("admin/create_user.css");
    $page->addHtml($html);
} else {
    $infos = $_POST;
    $courses =$db->getCourses();
    $is_same = false;
    var_dump($infos);
    foreach ($courses as $course) {

        if ($course[1]==urlencode($infos["course"])) {
            $is_same = true;
            break;
        }
    }
    if ($is_same) {

        #$db->createNewUsers(intval($infos["number_of_accounts"]),$infos["course"],$infos["role_select"]);
    }

}
$page->printPage();
