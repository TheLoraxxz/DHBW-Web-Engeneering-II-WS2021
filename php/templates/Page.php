<?php

class Page {
    private $htmlString = "";
    private $title = "";

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }


    public function printPage() {
        try {
            if ($this->title != "") {

                echo("<!DOCTYPE html>
<html>
    <head>
        <title>");
                echo($this->title);
                echo("</title>
    </head>
    <body></body>
</html>");
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            var_dump($e);
        }


    }
}