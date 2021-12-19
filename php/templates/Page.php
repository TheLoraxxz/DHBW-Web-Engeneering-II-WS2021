<?php
require ('DBService.php');
class Page {
    protected $htmlString = "";
    protected $title = "Gradlappain";
    protected $css = [];
    protected $js = [];
    protected $db;
    protected $isSession= null;
    protected $role = null;
    protected $messages = [];
    protected $Element;
    protected $subMenu =[];
    protected $ROOTLIB;
    /**
     * on construction it creates the DBservice
     * then adds the standard javascript and bootstrapp to it and then finishes
    */
    public function __construct() {
        $this->db = new DBService();
        if (!$this->db) {
            $this->showError("Datenbankfehler");
            $this->printPage();
            exit();
        }
        $this->ROOTLIB = self::getRoot();
        $this->addCs("template/forAll.css");
        $this->addJs("js_Libary/bootstrap/bootstrap.js");
        $this->addJs("forAll.js");

    }
    /**
     * sets the title of the Application
    */
    public function setTitle($title) {
        $this->title = $title;
    }
    /**
     * gives you the db service to make it easier tzo include
    */
    public function getDBService() {
        return $this->db;
    }
    /**
     * this continously adds html string which then will be printed out
    */
    public function addHtml($string) {
        $this->htmlString=$this->htmlString.$string;
    }

    /**
     * sgets lgoinsession --> gets session
     * looks whether session is the same if so it it returns true
     * else it throws oyu to the home website
    */
    public function getLoginstatus($session_current) {
        $sessions = $this->db->getUserSession();
        if ($session_current!=null) {
            foreach ($sessions as $session) {
                if ($session_current==$session) {
                    $this->isSession =substr($session,0,1);
                    $this->role = $this->db->getRole($this->isSession)[0][0];
                    return true;
                }
            }
        }
        header('Location: '.$this->ROOTLIB);
        die();
    }

    /**
     * @param $hrefToScript
     * @throws Exception
     * add js --> needs to be in js file js/ and does not need a backslash at the beginning
     */
    public function addJs($hrefToScript) {
        $hrefToScript = $this->ROOTLIB."js/".$hrefToScript;
        $isJs = substr($hrefToScript,-2);
        if($isJs=="js") {
            array_push($this->js,$hrefToScript);
        } else {
            throw new Exception("KEIN VALIDES JS FILe");
        }
    }
    public static function getRoot() {
        $rootlib = dirname(__FILE__); //gets the directory this one is in --> used for adding scripts
        return substr($rootlib,strpos($rootlib,"htdocs")+6)."/../../";
    }
    public function addElement($element) {
        $this->Element = $element;
    }

    /**
     * @param $hrefToCss
     * @throws Exception
     * adds Css, if it is not the right path it is ignored --> needs to be from the css/ file
     * does not need backslash at the beginning
     */
    public function addCs($hrefToCss) {
        $hrefToScript = $this->ROOTLIB."css/".$hrefToCss;
        $isCss = substr($hrefToScript,-3);
        if($isCss=="css") {
            array_push($this->css,$hrefToScript);
        } else {
            throw new Exception("Kein Valides CSS File");
        }
    }

    /**
     * one error is shown
    */
    public function showError($message) {
        $message =strip_tags($message);
        $error = ["type"=>"error","message"=>$message];
        array_push($this->messages,$error);

    }
    /**
     * shows success --> adds properties to success
     */
    public function showSuccess($message) {
        $message =strip_tags($message);
        array_push($this->messages,["type"=>"success","message"=>$message]);
    }
    /**
     * gets current session (the user id)
    */
    public function getSession() {
        return (int) $this->isSession;
    }
    /**
     * gives back the the role 1 2 or 3
    */
    public function getRole() {
        return (int) $this->role;
    }
    /**
     * print the page so it has a coherant look everywhere
     */
    public function printPage() {
        if (isset($this->Element)) {
            $this->addCs($this->Element->css);
        }
        //adds error
        echo('<!DOCTYPE html>
              <html>');
        echo(' 
        <head>
            <meta charset="UTF-8" lang="de">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <link rel="stylesheet" href="'.$this->ROOTLIB  .'css/bootstrap/bootstrap.css">
            <title>'.$this->title.'</title>
        ');
        foreach ($this->js as $js) { ///for each js file that is added it is included in the script
            echo('<script src="'.$js.'"></script>');
        }
        foreach ($this->css as $css) { //same is for css file
            echo ('<link rel="stylesheet" href="'.$css.'">');
        }
        echo("</head>");
        echo("<body>");
        if(!$this->isSession==null) { //if it logs in it inserts the header elsewise you just see blank
            $nav ="";
            switch ($this->role) { //depending on the session it shows the corrisponding header
                case 1:
                    $nav ='
                        <a class="nav-link">Noten</a>
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="'.self::getRoot().'">Home</a></li>
                            <li><a class="dropdown-item" href="'.self::getRoot().'php/admin/create_user.php?action=overview">User Management</a></li>
                        </ul>
                        <a class="nav-link">Projekte</a>
                    ';
                    break;
                case 2:
                    $nav ='
                        <a class="nav-link">Bewertungen</a>
                        <a class="nav-link">Projekte</a>
                    ';
                    break;
                case 3:
                    $nav = '
                        <a class="nav-link">Noten</a>
                    ';
                    break;
            }
            echo('
                <nav class="navbar navbar-light bg-light navbar-expand-sm">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="'.self::getRoot().'index.php">Gradlappain</a>
                        <div class="collapse navbar-collapse" id="navbar">
                            <div class="navbar-nav">
                              '.$nav.'
                            </div>
                        </div>
                        <a class="nav-link navbar-icon"><img src="'.$this->ROOTLIB.'assets/Icons/profile.svg"></a>
                        <a class="nav-link navbar-icon" href="'.$this->ROOTLIB.'index.php?action=logout"><img src="'.$this->ROOTLIB.'assets/Icons/logout.svg"></a>
                    </div>
                </nav>
                ');
            //prints nav bar
        }
        if (count($this->messages)>0) { //each error message or message in general is printed
            foreach ($this->messages as $message) {
                if ($message["type"]=="error") {
                    echo('
                    <div class="container message">
                        <div class="alert alert-danger">'.$message["message"].'</div>
                    </div>');
                } else if ($message["type"]=="success") {
                    echo ('                    
                    <div class="container message">
                        <div class="alert alert-success">'.$message["message"].'</div>
                    </div>');
                }
            }
        }
        if (isset($this->Element)) {
            echo($this->Element->printElement());
        }
        echo($this->htmlString);
        echo("</body>");
        echo("</html>");
    }


}
