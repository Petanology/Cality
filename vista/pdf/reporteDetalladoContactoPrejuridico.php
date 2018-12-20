<?php

    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validacionDetalladoDP($_POST["asesorConsulta"] , $_POST["mesReporte"]);
    
    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){

        require_once("../../modelo/asesorDao.php");
        require_once("../../modelo/generarPDFDao.php");
        require_once("generalPDFDetallado-DP.php");
        require_once("funcionesColorFondoDetallado.php");

        $pdf = new PDFDP_D('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 

        // Varaibles generales
        $pdf->mesReporte = $_POST["mesReporte"]; 
        $pdf->asesorConsulta = $_POST["asesorConsulta"];    

        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        // Declaración de variables
        $grupoSETValor = 0;
        $grupoNEGValor = 0;
        $grupoNEG2Valor = 0;
        $grupoRSValor = 0;
        
        // Listar informacion general del asesor
        $objetoAsesorD = new asesorDao();
        $resultadoObjetoAsesorD = $objetoAsesorD->listarInfoAsesorDetallado($pdf->asesorConsulta); 


        $pdf->SetFont('Arial','B',7);
        foreach($resultadoObjetoAsesorD as $rowResultadoObjetoAsesorD){
            // Informacion Asesor
            $pdf->SetFillColor(86, 101, 115);
            $pdf->SetDrawColor(86, 101, 115);
            $pdf->SetTextColor(255,255,255); 
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0,6,"INFORMACION GENERAL DEL GESTOR",1,1,'C',1); 
            
            
            $pdf->SetFillColor(128, 139, 150);
            $pdf->SetDrawColor(128, 139, 150);
            $pdf->SetTextColor(255,255,255); 
            $pdf->Cell(80,5,"Nombres completos",1,0,'C',1); 
            
            $pdf->SetFillColor(213, 216, 220);
            $pdf->SetDrawColor(213, 216, 220);
            $pdf->SetTextColor(39, 55, 70);
            $pdf->Cell(0,5,$rowResultadoObjetoAsesorD[0],1,1,'C',1);
            
        
            $pdf->SetFillColor(128, 139, 150);
            $pdf->SetDrawColor(128, 139, 150);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(80,5,"Número de identificación",1,0,'C',1); 
            
            $pdf->SetFillColor(213, 216, 220);
            $pdf->SetDrawColor(213, 216, 220);
            $pdf->SetTextColor(39, 55, 70);
            $pdf->Cell(0,5,$rowResultadoObjetoAsesorD[1],1,1,'C',1);
            
            
            $pdf->SetFillColor(128, 139, 150);
            $pdf->SetDrawColor(128, 139, 150);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(80,5,"Nombre de usuario",1,0,'C',1); 
            
            $pdf->SetFillColor(213, 216, 220);
            $pdf->SetDrawColor(213, 216, 220);
            $pdf->SetTextColor(39, 55, 70);
            $pdf->Cell(0,5,$rowResultadoObjetoAsesorD[3],1,1,'C',1);
            
            $pdf->Ln(5);

            // Informacion Lider
            $pdf->SetFillColor(86, 101, 115);
            $pdf->SetDrawColor(86, 101, 115);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0,6,"NOMBRE COMPLETO DEL LIDER",1,1,'C',1); 

            $pdf->SetFillColor(213, 216, 220);
            $pdf->SetDrawColor(213, 216, 220);
            $pdf->SetTextColor(39, 55, 70);
            $pdf->Cell(0,5,$rowResultadoObjetoAsesorD[2],1,1,'C',1);
        }
        $pdf->Ln(7); 
        
        
        // --------------------------------------------------
        
        $objetoPDFDao = new generarPDFDao();
        $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDP($pdf->mesReporte);

        foreach($rValorPDF as $rowRV){
            global $grupoSETValor; 
            global $grupoNEGValor; 
            global $grupoNEG2Valor; 
            global $grupoRSValor; 
            $grupoSETValor = $rowRV[0];
            $grupoNEGValor = $rowRV[1];
            $grupoNEG2Valor = $rowRV[2];        
            $grupoRSValor = $rowRV[3];        
        }
        
        
        $pdf->SetDrawColor(17, 122, 101);
        $pdf->SetTextColor(39, 55, 70); 
        $pdf->Cell(0,8,"PUNTAJES GLOBALES","BT",1,'C',0); 
        $pdf->Ln(6); 
        

        $pdf->SetFillColor(69, 179, 157);
        $pdf->SetDrawColor(69, 179, 157);
        $pdf->SetTextColor(255,255,255); 
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,"SERVICIO Y ETIQUETA TELEFÓNICA [ $grupoSETValor% ]",0,1,'C',1); 
        
        // Instancia a Generar PDF
        $objetoGenerarPDFD = new generarPDFDao();

        // Listar Resultados SET
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDPSET($pdf->asesorConsulta,$pdf->mesReporte); 
        foreach($resultadoNota as $rowResultadoNota){

            $pdf->SetFillColor(235, 237, 239);
            impresionAprobado($rowResultadoNota[0]);
            $pdf->Cell(25,5," " . $rowResultadoNota[0],0,0,'C',1); 
            $pdf->SetTextColor(39, 55, 70); 
            $pdf->SetFillColor(214, 219, 223);
            $pdf->MultiCell(0,5," " . $rowResultadoNota[1],0,'J',1);

        }
        $resultadoNota = null;
        $pdf->Ln(5); 
        
        
        $pdf->SetFillColor(69, 179, 157);
        $pdf->SetDrawColor(69, 179, 157);
        $pdf->SetTextColor(255,255,255); 
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,"NEGOCIACION I [ $grupoNEGValor% ]",0,1,'C',1); 
        // Listar Resultados IT
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDPNEG($pdf->asesorConsulta,$pdf->mesReporte); 
        foreach($resultadoNota as $rowResultadoNota){
            $pdf->SetFillColor(235, 237, 239);
            impresionAprobado($rowResultadoNota[0]);
            $pdf->Cell(25,5," " . $rowResultadoNota[0],0,0,'C',1); 
            $pdf->SetTextColor(39, 55, 70); 
            $pdf->SetFillColor(214, 219, 223);
            $pdf->MultiCell(0,5," " . $rowResultadoNota[1],0,'J',1);

        }
        $resultadoNota = null;
        $pdf->Ln(5); 
        
        $pdf->SetFillColor(69, 179, 157);
        $pdf->SetDrawColor(69, 179, 157);
        $pdf->SetTextColor(255,255,255); 
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,"NEGOCIACION II [ $grupoNEG2Valor% ]",0,1,'C',1); 
        
        // Listar Resultados RS
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDPNEG2($pdf->asesorConsulta,$pdf->mesReporte); 
        foreach($resultadoNota as $rowResultadoNota){
            $pdf->SetFillColor(235, 237, 239);
            impresionAprobado($rowResultadoNota[0]);
            $pdf->Cell(25,5," " . $rowResultadoNota[0],0,0,'C',1); 
            $pdf->SetTextColor(39, 55, 70); 
            $pdf->SetFillColor(214, 219, 223);
            $pdf->MultiCell(0,5," " . $rowResultadoNota[1],0,'J',1);

        }
        $resultadoNota = null;
        $pdf->Ln(5); 
        
        
        $pdf->SetFillColor(69, 179, 157);
        $pdf->SetDrawColor(69, 179, 157);
        $pdf->SetTextColor(255,255,255); 
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,"REGISTRO EN EL SISTEMA [ $grupoRSValor% ]",0,1,'C',1); 
        
        
        // Listar Resultados RS
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDPRS($pdf->asesorConsulta,$pdf->mesReporte); 
        foreach($resultadoNota as $rowResultadoNota){
            $pdf->SetFillColor(235, 237, 239);
            impresionAprobado($rowResultadoNota[0]);
            $pdf->Cell(25,5," " . $rowResultadoNota[0],0,0,'C',1); 
            $pdf->SetTextColor(39, 55, 70); 
            $pdf->SetFillColor(214, 219, 223);
            $pdf->MultiCell(0,5," " . $rowResultadoNota[1],0,'J',1);

        }
        $resultadoNota = null;

    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","informe-vd-detallado-negociacion-prejuridica-$pdf->mesReporte.pdf");
        
    }
    else{
        header("location: indexDetalladoDP.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>