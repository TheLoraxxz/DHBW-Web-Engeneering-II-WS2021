<?php

class Table {
    private $data= null;
    private $columns = [];
    public function __construct($data) {
        $this->data = $data;
    }

    public function addColumn($name,$innerHTTML=null) {
        if($innerHTTML==null) {
            array_push($this->columns,["name"=>$name,"HTML"=>null]);
        }
        array_push($this->columns,["name"=>$name,"HTML"=>$innerHTTML]);
    }


    public function printTable() {
        $string = '
            <table class="table table-striped">
                <thead>
                    <tr>';
        for ($i=0;$i<count($this->columns);$i++) {
            $string = $string.'<tr>'.$this->columns[$i].'</tr>';
        }
        $string = $string.'
                    </tr>                
                </thead>
                <tbody>';
        for ($i=0;$i<count($this->data);++$i) {
            $string = $string.'<tr>';
            for ($j=0;$j<count($this->columns);$j++) {
                if ($this->columns[$i]==null) {

                }
            }
            $string = $string.'</tr>';
        }
        $string = $string.'
                </tbody>
            </table>
        ';
    }
}
