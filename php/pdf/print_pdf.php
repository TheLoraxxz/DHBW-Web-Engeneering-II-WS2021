<?php
require_once ('./../templates/Page.php');
require_once('pdf.php');
$page = new Page();
$page->getLoginstatus($_COOKIE["GradlappainCook"]);
if (isset($_GET["source"])) {
    if ($_GET["source"]=="home") {
        $db = $page->getDBService();
        if ($page->getRole()==3) {
            $data =$db->getSecretareHomeTable($page->getSession());
            if(count($data)>0) {
                for($i=0;$i<count($data);++$i) {
                    $points_reahable = $data[$i][5];
                    $data[$i][5] = $data[$i][4];
                    $data[$i][4] =$points_reahable;
                }

                $pdf = new PDF();
                $pdf->SetFont('Arial','',12);
                $pdf->AddPage();
                $pdf->printTableBasic($data,['Vorname','Name','Gruppe','Punkte','Punkte gesamt','Abgabedatum']);
                $pdf->Output();
            } else {
                header('Location: '.$page::getRoot().'php/home.php?error=noData');
            }

        }
    } elseif ($_GET["source"]=="create_user") {
        $db = $page->getDBService();

        $data =$db->getAllUsersByID(intval($_GET["start"]),intval($_GET["end"]));

        $pdf = new PDF();
        $pdf->SetFont('Arial','',8);
        $pdf->AddPage();
        $pdf->printTableBasic($data,['ID','Name','Kurs','Password']);
        $pdf->Output();
    }
}
