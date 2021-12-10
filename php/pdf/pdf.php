<?php
/**
 @author: Tilmann Lorenz --> 2447899
 */
require('./../../php-libaries/PDF/fpdf.php');
class PDF extends FPDF {
    function printTableBasic($data,$header) {
        foreach ($header as $col) {
            $this->Cell(30,10,$col,1);
        }
        $this->Ln();
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(30,10,$col,1);
            $this->Ln();
        }

    }
}
