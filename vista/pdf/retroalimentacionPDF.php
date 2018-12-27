<?php

    require_once("../../modelo/retroalimentacionDao.php");
    require_once("../../controlador/zonaHoraria.php");

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
        $pdf->codigo = $_POST["codigo"]; 
        $pdf->version = $_POST["version"]; 
        $pdf->ultimosDias = $_POST["ultimosDias"];    
        $pdf->puntaje = $_POST["puntaje"];    
        $pdf->fechaVersion = $_POST["fechaVersion"];    
        $pdf->corte = $_POST["corte"];    

        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        $oRetroDao = new retroalimentacionDao();
        $resultadoORetroDao = $oRetroDao->listarRetroalimentacion($pdf->tabla,$pdf->ultimosDias,$pdf->puntaje);
        
        // $this->SetTextColor(45,50,38);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(20,20,20);
        $pdf->SetDrawColor(50,50,50);
        
        
        foreach($resultadoORetroDao as $rowRORetroDao){
            $pdf->SetFillColor(240,240,240);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(98,5,"  FECHA:   $rowRORetroDao[0]","LTR",0,'L',1); 
            $pdf->Cell(98,5,"  NOMBRE:   $rowRORetroDao[2]","TR",1,'L',1);
            $pdf->Cell(98,5,"  UNIDAD:   $rowRORetroDao[1]","LBR",0,'L',1);
            $pdf->Cell(98,5,"  NOTA:   $rowRORetroDao[3]","BR",1,'L',1);    
            
            $pdf->Ln(4);
            
            $pdf->Cell(0,5,"OPORTUNIDADES DE MEJORA:",0,1,"L",0);    
            $pdf->SetFont('Arial','',8);
            
            $obsOportunidad = explode("OPORTUNIDADES:",$rowRORetroDao[4]);
            $obsOportunidad[1] = preg_replace("/[\r\n|\n|\r]+/", PHP_EOL, $obsOportunidad[1]);

            $pdf->MultiCell(0,5,$obsOportunidad[1],0,"J",0);
            
            $pdf->Cell(0,1,"","B",1,0,0);    
            
            $pdf->Ln(2);
            
            $pdf->WriteHTML('<p align="justify">Para  <b>GF COBRANZAS JURIDICAS</b> la calidad en la gestión  y el compromiso de la mejora continua  es pilar fundamental en nuestra labor diaria; Parte de esa labor diaria  es realizar  las gestiones bajo los parámetros  indicados, parámetros que queremos retroalimentar para su mejora continua.</p>');
            
            $pdf->ln(7);
            
            $pdf->Cell(0,5," SÉ QUE DEBO: ","LTR",1,1);
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