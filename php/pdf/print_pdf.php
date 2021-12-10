<?php
require ('../templates/Page.php');
require (Page::getRoot()."php-libaries/PDF/fpdf.php");

class PDF extends FPDF {
    function BasicTable($data,$header) {
        foreach ($header as $col) {
            $this->Cell(40,10,$col,1);
        }
        $this->Ln();

    }
}
