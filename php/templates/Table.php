<?php

class Table
{
    private $data = null;
    private $columns = [];
    private $button = [];
    public $css = "template/table.css";
    private $header = "";
    //data is stores (must be 2D array)
    public function __construct($data)
    {
        $this->data = $data;
    }
    //adds a table header
    public function addTableHeading($string) {
        $this->header = $string;
    }
    /**
     * adds column the name --> name that the column has
     * column in Data --> cis the index in the array
     * show --> if true it is shown if false it is not hoswn
     * innerHTML --> insets own HTML
    */
    public function addColumn($name, $columnInData, $show = true, $innerHTTML = null)
    {
        if ($innerHTTML == null) {
            array_push($this->columns, ["name" => $name, "HTML" => null, "col" => $columnInData, "show" => $show]);
        } else {
            array_push($this->columns, ["name" => $name, "HTML" => $innerHTTML, "col" => $columnInData, "show" => $show]);
        }

    }
    /**
     * adds button to the top of the table so you can have general buttons there
    */
    public function addButton($name, $link)
    {
        array_push($this->button, ["name" => $name, "link" => $link]);
    }
    /**
     * is called by the page.php
     * and it prints everything out
    */
    public function printElement() {

        $string = '<div class="container-fluid tableCustom">';
        if (strlen($this->header)>0) {
            $string = $string.'<h3>'.$this->header.'</h3>';
        }
        if (count($this->button) > 0) {
            $string = $string.'<div class="buttongroup"><div class="btn-group btns">';
            for ($i = 0; $i < count($this->button); $i++) {
                $string = $string . '<button  class="btn btn-outline-secondary" onClick="(function (){
                window.location.href=\''.$this->button[$i]["link"].'\';})() ;">'.
                    $this->button[$i]["name"] . '</button>';
            }
            $string = $string . '</div></div>';
        }

        if (count($this->data) == 0) {
            $string = $string . '<div>Keine Daten vorhanden</div>';
        } else {
            $string = $string . '
                <table class="table table-striped">
                    <thead>
                        <tr>';
            if (count($this->columns) > 0) {
                for ($i = 0; $i < count($this->columns); ++$i) { //make Thgead and the head of the table
                    if ($this->columns[$i]["show"]) { // if it is suppoed to be shown it
                        $string = $string . '<td>' . $this->columns[$i]["name"] . '</td>';
                    } else {
                        if ($this->columns[$i]["HTML"]==null) {
                            $string = $string . '<td style="display: none;">' . $this->columns[$i]["name"] . '</td>';
                        } else {
                            $string = $string . '<td style="display: none;">' . $this->columns[$i]["name"] . '</td>';
                        }

                    }
                }
            } else { //wenn keine Columns angegeben werde nwerden einfach alle Daten raus geschreiben
                for ($i = 0; $i < count($this->data[0]); $i++) {
                    $string = $string . '<td>' . $i . '</td>';
                }
            }
            $string = $string . '
                    </tr>                
                </thead>
                <tbody>';
            //tbody wird geschrieben
            for ($i = 0; $i < count($this->data); ++$i) { //für jede Daten wird
                $string = $string . '<tr id="' . $i . '">';
                if (count($this->columns) > 0) { //wenn wieder columns gesetzt sind werden diese genutzt
                    for ($j = 0; $j < count($this->columns); $j++) {
                        if ($this->columns[$j]["HTML"] == null) {
                            if ($this->columns[$j]["show"]) {
                                $string = $string . '<td>' . $this->data[$i][$this->columns[$j]["col"]] . '</td>';
                            } else {
                                $string = $string . '<td style="display:none;">' . $this->data[$i][$this->columns[$j]["col"]] . '</td>';
                            }
                        } else { //if the html is not inserted it just inserts the regular data
                            if ($this->columns[$j]["show"]) {
                                $string = $string . '<td>' . $this->columns[$j]["HTML"] . '</td>';
                            } else {
                                $string = $string . '<td style="display: none;">' . $this->columns[$j]["HTML"] . '</td>';
                            }

                        }
                    }
                } else {
                    for ($j = 0; $j < count($this->data[0]); $j++) {
                        $string = $string . '<td>' . $this->data[$i][$j] . '</td>';
                    }
                }
                $string = $string . '</tr>';
            }
            $string = $string . '
                    </tbody>
                </table>
        ';
        }

        return $string."</div>";
    }
}
