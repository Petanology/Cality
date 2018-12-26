<?php

    require_once("../../modelo/retroalimentacionDao.php");

    $SHIR = null;
    $vResultado = new retroalimentacionDao();
    $sihayInforme = $vResultado->validacionRetroalimentacion($_POST["tabla"] , $_POST["ultimosDias"] , $_POST["puntaje"]);

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }

    if(isset($SHIR)){
        require_once("generalPDF-Retroalimentacion.php");
        require_once("funcionesColorFondoDetallado.php");
        require_once("../../modelo/retroalimentacionDao.php");

        $pdf = new PDFRETROALIMENTACION('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 

        // Varaibles generales
        $pdf->tabla = $_POST["tabla"]; 
        $pdf->ultimosDias = $_POST["ultimosDias"];    
        $pdf->puntaje = $_POST["puntaje"];    

        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        $oRetroDao = new retroalimentacionDao();
        $resultadoORetroDao = $oRetroDao->listarRetroalimentacion($pdf->tabla,$pdf->ultimosDias,$pdf->puntaje);
        
        // $this->SetTextColor(45,50,38);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(20,20,20);
        $pdf->SetDrawColor(40,40,40);
        
        
        foreach($resultadoORetroDao as $rowRORetroDao){
            $pdf->SetFont('Arial','B',8);

            $pdf->SetLeftMargin(10);
            $pdf->Cell(98,5,"  FECHA:   $rowRORetroDao[0]",1,0,'L',0); 
            $pdf->Cell(98,5,"  NOMBRE:   $rowRORetroDao[2]",1,1,'L',0);
            $pdf->Cell(98,5,"  UNIDAD:   $rowRORetroDao[1]",1,0,'L',0);
            $pdf->Cell(98,5,"  NOTA:   $rowRORetroDao[3]",1,0,'L',0);
            
            
            $pdf->SetFont('Arial','',8);
            $pdf->Ln(8);
            
            $pdf->WriteHTML('<p align="justify">Para  <b>GF COBRANZAS JURIDICAS</b> la calidad en la gestión  y el compromiso de la mejora continua  es pilar fundamental en nuestra labor diaria; Parte de esa labor diaria  es realizar  las gestiones bajo los parámetros  indicados, parámetros que queremos retroalimentar para su mejora continua.</p>');
            
            $pdf->ln(8);

            $pdf->WriteHTML('<p align="justify"><b>OBSERVACION: </b>' . $rowRORetroDao[4] . '</p>');
            
            $pdf->ln(7);
            
            $pdf->Cell(0,5," ME COMPROMETO A: ","LTR",1,1);
            $pdf->Cell(0,22,"","LBR",1,1);
            
            $pdf->Ln(10);
            
            $pdf->Cell(54,5,"FIRMA ASESOR","T",0,"C",0);
            $pdf->SetLeftMargin(80);
            $pdf->Cell(54,5,"FIRMA ANALISTA CALIDAD","T",0,"C",0);
            $pdf->SetLeftMargin(150);
            $pdf->Cell(54,5,"FIRMA ANALISTA DE CARTERA","T",0,"C",0);
            $pdf->SetLeftMargin(0);
            $pdf->Ln(20);
        }

    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","retroalimentacion.pdf");
    }
    else{
        header("location: retroalimentacion.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>