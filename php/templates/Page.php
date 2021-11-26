<?php
class Page {
    private $htmlString = "";
    private $title = "Gradlappain";
    private $css = [];
    private $js = [];
    private $db;
    private $isSession= null;
    private $messages = [];

    private $ROOTLIB;
    public function __construct() {
        $this->db = new DBService();
        $rootlib = dirname(__FILE__); //gets the directory this one is in --> used for adding scripts
        $this->ROOTLIB = substr($rootlib,strpos($rootlib,"htdocs")+6)."/../../";
        $this->addCs("forAll.css");

    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function addHtml($string) {
        $this->htmlString=$this->htmlString.$string;
    }

    public function getLoginstatus($session_current) {
        $sessions = $this->db->getUserSession();
        if ($session_current==null) {
            return false;
        }
        foreach ($sessions as $session) {
            if ($session_current==$session) {
                $this->isSession = $session;
                return true;
            }
        }
        return false;
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


    public function showError($message) {
        $message =strip_tags($message);

        if(strlen($message)<30) {
            $error = ["type"=>"error","message"=>$message];
            array_push($this->messages,$error);
        }
    }

    public function printPage() {
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
        if(!$this->isSession==null) {
            echo('');
        }
        if (count($this->messages)>0) {
            foreach ($this->messages as $message) {
                if ($message["type"]=="error") {
                    echo('<div class="alert-danger">'.$message["message"].'</div>');
                }
            }
        }
        echo($this->htmlString);
        echo("</body>");
        echo("</html>");
    }


}
