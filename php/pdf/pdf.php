<?php
/**
 @author: Tilmann Lorenz --> 2447899
 * pdf class that creates a table with all neccesary informations that beeing givben
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
