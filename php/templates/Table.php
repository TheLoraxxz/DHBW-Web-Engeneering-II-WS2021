<?php

class Table
{
    private $data = null;
    private $columns = [];
    public $css = "template/table.css";
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function addColumn($name, $columnInData, $order, $innerHTTML = null)
    {
        if ($innerHTTML == null) {
            array_push($this->columns, ["name" => $name, "HTML" => null, "col" => $columnInData, "order" => $order]);
        }
        array_push($this->columns, ["name" => $name, "HTML" => $innerHTTML, "col" => $columnInData]);
    }


    public function printElement() {
        $string = '
            <div class="container-fluid tableCustom">
                <table class="table table-striped">
                    <thead>
                        <tr>';
        if (count($this->columns) > 0) {
            for ($i = 0; $i < count($this->columns); $i++) {
                $string = $string . '<td>' . $this->columns[$i] . '</td>';
            }
        } else {
            for ($i = 0; $i < count($this->data[0]); $i++) {
                $string = $string . '<td>'.$i.'</td>';
            }
        }
        $string = $string . '
                    </tr>                
                </thead>
                <tbody>';
        for ($i = 0; $i < count($this->data); ++$i) {
            $string = $string . '<tr>';
            if (count($this->columns) > 0) {
                for ($j = 0; $j < count($this->columns); $j++) {
                    if ($this->columns[$j]["HTML"] == null) {
                        $string = '<td>' . $this->data[$this->columns[$j]["col"]] . '</td>';
                    } else {
                        $string = '<td>' . $this->columns[$j]["HTML"] . '</td>';
                    }
                }
            } else {
                for ($j = 0; $j < count($this->data[0]); $j++) {
                    $string = $string.'<td>'.$this->data[$i][$j].'</td>';
                }
            }
            $string = $string . '</tr>';
        }
        $string = $string . '
                    </tbody>
                </table>
            </div>
        ';
        return $string;
    }
}
