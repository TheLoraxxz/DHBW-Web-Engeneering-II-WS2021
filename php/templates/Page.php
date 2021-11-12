<?php

class Page {
    private $htmlString = "";
    private $title = "Gradlappain";
    private $css = [];
    private $db;
    public function __construct() {
        $this->db = new DBService();

    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function printPage() {
        $sessions = $this->db->getUserSession();
        var_dump($sessions);
        echo("<!DOCTYPE html><html>");
        echo(" <head>
        <meta lang='de'>
        <link rel='stylesheet' href='./../../css/libary/bootstrap-3.4.1-dist/css/bootstrap-theme.css'>
        
        <title>".$this->title."</title>");
        echo("</head>");
        echo("<body></body>");
        echo("</html>");
    }
}