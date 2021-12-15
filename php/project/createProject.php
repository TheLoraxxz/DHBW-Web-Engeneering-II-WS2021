<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

$string = '
    <div class="container-md mt-5" >
    <h2>Projekt erstellen:</h2>
      <form class="row g-3" action="./createProject_done.php" method="post">
          <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Projektname</label>
            <input type="text" class="form-control" id="validationDefault01" required name ="name" >
          </div>
          <div class="col-md-2">
            <label for="validationDefault02" class="form-label">Maximale Anzahl Studenten</label>
            <input type="number" min="0" max="25" class="form-control" id="validationDefault02" required name ="max_of_students">
          </div>
          <div class="row">
            <div class="col-md-2">
                <label for="validationDefaultUsername" class="form-label">Erreichbare Punkte</label>
                <div class="input-group">
                    <input type="number" min="0" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required name="points_reachable">
                </div>
             </div>
              <div class="col-md-2">
                <label for="validationDefault03" class="form-label">Abgabedatum</label>
                <input type="date" class="form-control" id="validationDefault03" required name="submission_date">
              </div>
              <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Beitritt möglich</label>
                <select class="form-select" id="validationDefault04" required name="open_to_invite">
                  <option selected value="Ja">Ja</option>
                  <option>Nein</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Anmerkung</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="path_to_matrix"></textarea>
              </div>
          </div>
          <div class="col-12">
            <button class="btn btn-outline-secondary" type="submit">Erstellen</button>
          </div>
        </form>
    </div>
';

$page->addHtml($string);
$page->printPage();