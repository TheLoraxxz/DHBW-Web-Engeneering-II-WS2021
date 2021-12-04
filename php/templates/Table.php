<?php

class Table {
    private $data= null;
    private $columns = [];
    public function __construct($data) {
        $this->data = $data;
    }

    public function addColumn($name,$columnInData,$order,$innerHTTML=null) {
        if($innerHTTML==null) {
            array_push($this->columns,["name"=>$name,"HTML"=>null,"col"=>$columnInData,"order"=>$order]);
        }
        array_push($this->columns,["name"=>$name,"HTML"=>$innerHTTML,"col"=>$columnInData]);
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
                if ($this->columns[$j]["HTML"]==null) {
                    $string='<td>'.$this->data[$this->columns[$j]["col"]].'</td>';
                } else {
                    $string='<td>'.$this->columns[$j]["HTML"].'</td>';
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
