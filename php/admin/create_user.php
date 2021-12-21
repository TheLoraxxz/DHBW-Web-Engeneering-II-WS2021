<?php
require_once ('./../templates/Page.php');
require_once ('./../templates/Table.php');
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
if ($page->getRole()==1) {
    if (isset($_GET["action"])) {


        if ($_GET["action"] == "overview") {
            $table = new Table($db->getAllUsersByID(0, "(SELECT MAX(us.user_id) LIMIT 1)"));
            $table->addTableHeading("User Übersicht");
            $table->addButton("Schüler hinzufügen", Page::getRoot() . "php/admin/create_user.php?action=multiple_user");
            $table->addButton("Einzelner User hinzufügen", Page::getRoot() . "php/admin/create_edit_user.php?action=new");
            $table->addColumn("ID", "id", false);
            $table->addColumn("Name", "name");
            $table->addColumn("Kurs", "Kurs");
            $resetPassword = '
                <div>
                    <button class="btn btn-secondary" onclick="resetPasswordButton(this)">Zurücksetzen</button>
                </div>
            ';
            $table->addColumn("Passwort Zurücksetzen", -1, true, $resetPassword);
            $edit = '
                <div>
                    <button class="btn btn-secondary" onclick="editUser()">Bearbeiten</button>
                </div>
            ';
            $table->addColumn("Bearbeiten",-1,true,$edit);
            $page->addJs("admin/create_user.js");
            $page->addElement($table);
            if (isset($_GET["mes"]) and $_GET["mes"]=="success_reset") {
                $page->showSuccess("Password erfolgreich zurück gesetzt!");

            }


        } else if ($_GET["action"] == "multiple_user") {
            $html = '
            <div class="container-fluid main row">
                <div class="col-3">
                    <h5>Account</h5>
                     <div class="mb-3">
                        <label class="mb-1 form-label" for="number_of_accounts_input">Anzahl der zu kreeierenden Accounts</label>
                        <input type="number" class="form-control" id="number_of_accounts_input">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Kurs</span>
                        <input id="course_input" type="text" class="form-control">
                        <button class="btn btn-outline-secondary" onclick="hideShowCourse()">Neuer Kurs</button>
                    </div>
                </div>
                <div class="col-3" style="display: none" id="kurs">
                    <h5>Kurs</h5>
                    <div class="kurs-input" >
                        <label for="course_name" class="form-label">Name</label>
                        <input type="text" id="course_name" class="form-control">
                        <label class="form-label" for="institut_input">Institut</label>
                        <input type="text" id="institut_input"  class="form-control">
                    </div>
                    <button class="btn btn-info" onclick="saveCourse()">Save</button>
                    <button class="btn btn-secondary" onclick="hideShowCourse()">Cancel</button>
                </div>
                <div class="row">
                    <div class="col-3">
                        <button class="btn btn-primary" onclick="submit()">Submit</button>
                        <a href="create_user.php?action=overview"><button class="btn btn-outline-secondary">Zurück</button></a>
                    </div>
                </div>        
            </div>
            <form style="display: none" id="submitform" method="post" action="create_user.php">
                 <input name="action" id="action">
                 <input name="course_name" id="course">
                 <input name="institut" id="institut">
                 <input id="number_of_accounts" name="number">
            </form>
            ';
            try {
                $page->addCs("admin/create_user.css");
                $page->addJs("admin/create_user.js");
            } catch (Exception $e) {
                var_dump($e);
            }
            $page->addHtml($html);


        } else if ($_GET["action"] == "reset_password") {

            $password = password_hash("123456", PASSWORD_BCRYPT);
            $db->updateUser($_GET["id"], $password);
            header('Location: ./create_user.php?action=overview&mes=success_reset');
            die();

        }
    }

    if (isset($_POST["action"])) {
        $course = "";
        if ($_POST["action"] == "create_kurs") {
            $course = $db->createNewCourse(urldecode($_POST["course_name"]), $_POST["institut"]);
        } else if ($_POST["action"] == "create") {
            $course = urldecode($_POST["course_name"]);
        }
        $tableData = $db->createNewUsers(intval($_POST["number"]), $_POST["course_name"]);
        if ($tableData == null) {
            $page->showError("Fehler beim einfügen in der Datenbank ");
        } elseif ($tableData == -1) {
            $page->showError("Kurs: ,," . $_POST["course_name"] . "nicht gefunden");
            $html = '
                <div class="container-fluid"><a href="create_user.php"><button class="btn btn-primary">Zurück</button></a></div>
            ';
            $page->addHtml($html);
        } else {
            $table = new Table($tableData);
            $table->addColumn("Benutzername", "name");
            $table->addColumn("Password", "password");
            $table->addColumn("Kurs", "Kurs");
            $table->addButton("Zurück", Page::getRoot() ."php/home.php");
            $table->addButton("Drucken", Page::getRoot() . "pdf/print_pdf.php?source=create_user&start=" . $tableData[0]["id"] . "&end=" . $tableData[count($tableData) - 1]["id"]);
            $table->addTableHeading("Übersicht über neu erstellte User");
            $page->addElement($table);
        }

    }
    $page->printPage();


} else {
    $page->showError("Keinen Zugriff");
    $page->printPage();
}
