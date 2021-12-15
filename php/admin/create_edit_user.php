<?php
include_once('./../templates/Page.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$html = '
                <div class="container-fluid main">
                    <div class="row">
                        <div class="col-5">
                            <h5>Neuen Nutzer erstellen</h5>
                            <div class="mb-3">
                                <label class="form-label" for="login_input">Login:</label>
                                <input id="login_input" type="text" class="form-control mb-3">
                                <label class="form-label" for="email_input">E-Mail:</label>
                                <input type="text" id="email_input" class="form-control mb-3">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Vorname:</span>
                                <input class="form-control" type="text" id="surename_input" >
                                <span class="input-group-text">Nachname:</span>
                                <input class="form-control" type="text" id="name_input">
                            </div>
                            <hr>
                            <p>Rollenberechtigung:</p>
                            <div>
                                <div class="form-check">
                                    <input type="radio" name="role" value="2" class="form-check-input" id="role_input_S">
                                    <label class="form-check-label" for="role_input_S">Student</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="role" value="3" class="form-check-input" id="role_input_Se">
                                    <label class="form-check-label" for="role_input_Se">Secretary</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="role" value="1" class="form-check-input" id="role_input_A">
                                    <label class="form-check-label" for="role_input_A">Admin</label>
                                </div>
                            </div>
                            <hr>
                            <p>Zugehörigkeit:</p>
                            <div>
                                <label class="form-label" for="kurs_input">Kurs:</label>
                                <div class="input-group">
                                    <input type="text" id="kurs_input" class="form-control">
                                    <button class="btn btn-outline-info">Neuer Kurs</button>
                                </div>
                                <label class="form-label" for="institut_input">Institut:</label>
                                <input type="text" class="form-control" id="institut_input">
                            </div>
                        </div>
                    </div>
                </div>
            ';
try {
    $page->addCs("admin/create_user.css");
    $page->addJs("admin/create_user.js");
} catch (Exception $e) {
    var_dump($e);
}
$page->addHtml($html);
$page->printPage();
