<?php
    require_once("../../modelo/ejemploDao.php");
    require_once("generalPDF-DC.php");

    // Página vertical, tamaño carta, medición en Milímetros 
    $pdf = new PDF('P','mm','letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(52, 152, 219);
    $pdf->SetDrawColor(52, 152, 219);
    $pdf->Cell(0,6,'ID',1,0,'C',1);
    
    /*
    $pdf->Cell(70,6,'NOMBRE',1,0,'C',1);
    $pdf->Cell(70,6,'ESTADO',1,1,'C',1);
    */

    $ejemploDao = new ejemploDao();
    $listar = $ejemploDao->ejemplo();


    /*
    $filaTabla = 1;
    foreach($listar as $rowEJE){
        
        if($filaTabla % 2 == 0){
            $pdf->SetFillColor(220,220,220);
        }else {
            $pdf->SetFillColor(255,255,255);
        }
        $pdf->Cell(20,6,$rowEJE[0],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[1],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[2],1,1,'C',1);
            
            
        $filaTabla++;
    }*/

    /*
        $pdf->Cell(70,6,"ejemplo",0,0,'C',1);
        $pdf->Cell(70,6,"ejemplo",0,1,'C',1);

    foreach($resultado as $row){
        
        $pdf->Cell(20,6,$row[0],1,0,'C',1);
        $pdf->Cell(70,6,$row[1],1,0,'C',1);
        $pdf->Cell(70,6,$row[2],1,1,'C',1);
        
    }

    */

    $pdf->Close();
    $pdf->Output("I","informe-venta-directa_agosto-2018.pdf");
?>



































