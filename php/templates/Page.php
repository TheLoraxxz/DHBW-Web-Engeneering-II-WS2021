<?php

class Page {
    private $htmlString = "";
    private $title = "Gradlapp";
    private $css = [];
    private $db;
    public function __construct() {
        $this->db = new DBService();

    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function printPage() {
        $this->db->getUserSession();
        echo("<!DOCTYPE html><html>");
        echo(" <head>
        <meta lang='de'>
        <title>".$this->title."</title>");
        echo("</head>");
        echo("<body></body>");
        echo("</html>");
    }
}