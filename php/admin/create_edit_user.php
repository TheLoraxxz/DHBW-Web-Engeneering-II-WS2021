<?php
include_once('./../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

if($page->getRole() == 1) {

    $id = $_GET["user_id"];

    if(isset($id)) {
        if($id > 0) {
            $userArray = $db->getUser($id);

            $html = '
                    <form action="./create_edit_user_done.php" method="post">
                        <div class="container-fluid main">
                            <div class="row">
                                <div class="col-5">
                                    <h5>Neuen Nutzer erstellen</h5>
                                    <div class="mb-3">
                                        <label class="form-label" for="login_input">Login:</label>
                                        <input id="user_id" value="'.$id.'"type="text" class="form-control mb-3" name="user_id" style="display:none">
                                        <input id="login" value="'.$userArray[0][4].'"type="text" class="form-control mb-3" name="login" required>
                                        <label class="form-label" for="email_input">E-Mail:</label>
                                        <input type="email" value="'.$userArray[0][3].'"id="email" class="form-control mb-3" name ="email" required>
                                        <label class="form-label" for="login_input">Passwort:</label>
                                        <input id="password" type="text" class="form-control mb-3" name="password">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Vorname:</span>
                                        <input class="form-control" value="'.$userArray[0][6].'"type="text" id="surename" name="surename" required>
                                        <span class="input-group-text">Nachname:</span>
                                        <input class="form-control" value="'.$userArray[0][5].'"type="text" id="name" name="name" required>
                                    </div>
                                    <hr>
                                    <p>Rollenberechtigung:</p>
                                    <div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="2" class="form-check-input" id="role_input_S" required>
                                            <label class="form-check-label" for="role_input_S">Student</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="3" class="form-check-input" id="role_input_Se" required>
                                            <label class="form-check-label" for="role_input_Se">Secretary</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="1" class="form-check-input" id="role_input_A" required>
                                            <label class="form-check-label" for="role_input_A">Admin</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Zugehörigkeit:</p>
                                    <div>
                                        <label class="form-label" for="course_input">Kurs:</label>
                                        <div class="input-group">
                                            <input type="text" value="'.$userArray[0][7].'"id="course_input" class="form-control" name="course_input" required>
                                        </div>
                                        <div id="institute_input">
                                            <label class="form-label">Institut:</label>
                                            <input id="institute" value="'.$userArray[0][8].'"type="text" class="form-control" name="institute" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12 mt-3">
                                <button class="btn btn-outline-secondary" type="submit">Erstellen</button>
                             </div>
                        </div>
                    </form>
                ';
        } else {
            $html = '
                    <form action="./create_edit_user_done.php" method="post">
                        <div class="container-fluid main">
                            <div class="row">
                                <div class="col-5">
                                    <h5>Neuen Nutzer erstellen</h5>
                                    <div class="mb-3">
                                        <label class="form-label" for="login_input">Login:</label>
                                        <input id="user_id" value="'.$id.'"type="text" class="form-control mb-3" name="user_id" style="display:none" required>
                                        <input id="login" type="text" class="form-control mb-3" name="login">
                                        <label class="form-label" for="email_input">E-Mail:</label required>
                                        <input type="email" id="email" class="form-control mb-3" name="email">
                                        <label class="form-label" for="login_input">Passwort:</label>
                                        <input id="password" type="text" class="form-control mb-3" name="password" required>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Vorname:</span>
                                        <input class="form-control" type="text" id="surename" name="surename" required>
                                        <span class="input-group-text">Nachname:</span>
                                        <input class="form-control" type="text" id="name" name="name" required>
                                    </div>
                                    <hr>
                                    <p>Rollenberechtigung:</p>
                                    <div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="2" class="form-check-input" id="role_input_S" required>
                                            <label class="form-check-label" for="role_input_S">Student</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="3" class="form-check-input" id="role_input_Se" required>
                                            <label class="form-check-label" for="role_input_Se">Secretary</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="1" class="form-check-input" id="role_input_A" required>
                                            <label class="form-check-label" for="role_input_A">Admin</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Zugehörigkeit:</p>
                                    <div>
                                        <label class="form-label" for="course_input">Kurs:</label>
                                        <div class="input-group">
                                            <input type="text" id="course_input" class="form-control" name="course_input" required>
                                        </div>
                                        <div id="institute_input">
                                            <label class="form-label">Institut:</label>
                                            <input id="institute" type="text" class="form-control" name="institute" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12 mt-3">
                                <button class="btn btn-outline-secondary" onclick="">Erstellen</button>
                             </div>
                        </div>
                    </form>
                ';
        }
    } else {
        $html = '
                    <form action="./create_edit_user_done.php" method="post">
                        <div class="container-fluid main">
                            <div class="row">
                                <div class="col-5">
                                    <h5>Neuen Nutzer erstellen</h5>
                                    <div class="mb-3">
                                        <label class="form-label" for="login_input">Login:</label>
                                        <input id="user_id" value="'.$id.'"type="text" class="form-control mb-3" name="user_id" style="display:none" required>
                                        <input id="login" type="text" class="form-control mb-3" name="login">
                                        <label class="form-label" for="email_input">E-Mail:</label required>
                                        <input type="email" id="email" class="form-control mb-3" name="email">
                                        <label class="form-label" for="login_input">Passwort:</label>
                                        <input id="password" type="text" class="form-control mb-3" name="password" required>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Vorname:</span>
                                        <input class="form-control" type="text" id="surename" name="surename" required>
                                        <span class="input-group-text">Nachname:</span>
                                        <input class="form-control" type="text" id="name" name="name" required>
                                    </div>
                                    <hr>
                                    <p>Rollenberechtigung:</p>
                                    <div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="2" class="form-check-input" id="role_input_S" required>
                                            <label class="form-check-label" for="role_input_S">Student</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="3" class="form-check-input" id="role_input_Se" required>
                                            <label class="form-check-label" for="role_input_Se">Secretary</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="role" value="1" class="form-check-input" id="role_input_A" required>
                                            <label class="form-check-label" for="role_input_A">Admin</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Zugehörigkeit:</p>
                                    <div>
                                        <label class="form-label" for="course_input">Kurs:</label>
                                        <div class="input-group">
                                            <input type="text" id="course_input" class="form-control" name="course_input" required>
                                        </div>
                                        <div id="institute_input">
                                            <label class="form-label">Institut:</label>
                                            <input id="institute" type="text" class="form-control" name="institute" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12 mt-3">
                                <button class="btn btn-outline-secondary" onclick="">Erstellen</button>
                             </div>
                        </div>
                    </form>
                ';
    }

    try {
        $page->addCs("admin/create_user.css");
        $page->addJs("admin/create_edit_user.js");
    } catch (Exception $e) {
        var_dump($e);
    }
    $page->addHtml($html);
} else {
    $page->showError("Keinen Zugriff");
}

$page->printPage();
