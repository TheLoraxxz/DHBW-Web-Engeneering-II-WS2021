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
        //$sessions = $this->db->getUserSession();

        echo("<!DOCTYPE html><html>");
        echo(" <head>
        <meta lang='de'>
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css\" integrity=\"sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu\" crossorigin=\"anonymous\">
        <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js\" integrity=\"sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd\" crossorigin=\"anonymous\"></script>
        <title>".$this->title."</title>");
        echo("</head>");
        echo("<body></body>");
        echo("</html>");
    }
}
