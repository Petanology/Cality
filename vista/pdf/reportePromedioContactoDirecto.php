<?php
    require_once("../../modelo/ejemploDao.php");
    require_once("generalPDF-DC.php");
    
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();


    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,6,'ID',1,0,'C',1);
    $pdf->Cell(70,6,'NOMBRE',1,0,'C',1);
    $pdf->Cell(70,6,'ESTADO',1,1,'C',1);


    $ejemploDao = new ejemploDao();
    $listar = $ejemploDao->ejemplo();

    $pdf->SetFont('Arial','',12);

    foreach($listar as $rowEJE){
        
        $pdf->Cell(20,6,$rowEJE[0],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[1],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[2],1,1,'C',1);

    }
    
    $pdf->Output();

    /*
        $pdf->Cell(70,6,"ejemplo",0,0,'C',1);
        $pdf->Cell(70,6,"ejemplo",0,1,'C',1);
    */




    /*
    
    foreach($resultado as $row){
        
        $pdf->Cell(20,6,$row[0],1,0,'C',1);
        $pdf->Cell(70,6,$row[1],1,0,'C',1);
        $pdf->Cell(70,6,$row[2],1,1,'C',1);
        
    }*/


?>


























