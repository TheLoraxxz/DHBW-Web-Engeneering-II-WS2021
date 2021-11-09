<?php

class Page {
    private $htmlString = "";
    private $title = "Gradlapp";

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }


    public function printPage() {
        echo("<!DOCTYPE html>
<html>
    <head>
        <meta lang='de'>
        
        <title>");
        echo($this->title);
        echo("</title>
    </head>
    <body></body>
</html>");
    }
}