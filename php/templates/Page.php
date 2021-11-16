<?php
class Page {
    private $htmlString = "";
    private $title = "Gradlappain";
    private $css = [];
    private $js = [];
    private $db;

    private $ROOTLIB;
    public function __construct() {
        $this->db = new DBService();
        $rootlib = dirname(__FILE__);
        $this->ROOTLIB = substr($rootlib,strpos($rootlib,"htdocs")+6)."../../../";

    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function addJs($hrefToScript) {
        $hrefToScript = $this->ROOTLIB.$hrefToScript;
        $isJs = substr($hrefToScript,-2);
        if($isJs=="js"&&file_exists($hrefToScript)) {
            array_push($this->js,$hrefToScript);
        } else {
            throw new Exception("KEIN VALIDES JS FILe");
        }
    }

    public function addCs($hrefToScript) {
        $hrefToScript = $this->ROOTLIB.$hrefToScript;
        $isCss = substr($hrefToScript,-3);
        if($isCss=="css"&&file_exists($hrefToScript)) {
            array_push($this->css,$hrefToScript);
        } else {
            throw new Exception("Kein Valides CSS File");
        }
    }

    public function printPage() {
        $sessions = $this->db->getUserSession();
        $session_set = false;
        echo('<!DOCTYPE html>
              <html>');
        echo(' 
        <head>
            <meta charset="UTF-8" lang="de">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <link rel="stylesheet" href="'.$this->ROOTLIB  .'css/bootstrap/bootstrap.css">
            <title>'.$this->title.'</title>
        ');
        foreach ($this->js as $js) {
            echo('<script src="'.$js.'"></script>');
        }
        foreach ($this->css as $css) {
            echo ('<link rel="stylesheet" href="'.$css.'">');
        }
        echo("</head>");
        echo("<body>");
        if ($session_set) {

        } else {
            echo($this->printLogin());
        }
        echo("</body>");
        echo("</html>");
    }

    private function printLogin() {
        $html = '
            <div class="container" >
                <form action="./login.php" method="post">
                    <h1>Bitte einloggen</h1>
                    <div>
                        <label for="name" class="form-label" >Name oder ID</label>
                        <input id="name" placeholder="Max Mustermann" type="text" maxlength="100" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Passwort</label>
                        <input id="password" type="password" class="form-control">
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        ';
        return $html;
    }
}
