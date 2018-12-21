<?php

    require_once("../../modelo/retroalimentacionDao.php");

    $SHIR = null;
    $vResultado = new retroalimentacionDao();
    $sihayInforme = $vResultado->validacionRetroalimentacion($_POST["tabla"] , $_POST["ultimosDias"] , $_POST["puntaje"]);

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }

    if(isset($SHIR)){
        require_once("generalPDFDetallado-DC.php");
        require_once("funcionesColorFondoDetallado.php");

        $pdf = new PDFDC_D('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 

        // Varaibles generales
        $pdf->mesReporte = $_POST["mesReporte"]; 
        $pdf->asesorConsulta = $_POST["asesorConsulta"];    

        $pdf->AliasNbPages();
        $pdf->AddPage();

        // Declaración de variables
        $grupoSETValor = 0;
        $grupoNEGValor = 0;
        $grupoCCValor = 0;
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
        $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDC($pdf->mesReporte);

        foreach($rValorPDF as $rowRV){
            global $grupoSETValor; 
            global $grupoNEGValor; 
            global $grupoCCValor; 
            global $grupoRSValor; 
            $grupoSETValor = $rowRV[0];
            $grupoNEGValor = $rowRV[1];
            $grupoCCValor = $rowRV[2];        
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
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDCSET($pdf->asesorConsulta,$pdf->mesReporte); 
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
        $pdf->Cell(0,7,"NEGOCIACION [ $grupoNEGValor% ]",0,1,'C',1); 
        // Listar Resultados IT
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDCNEG($pdf->asesorConsulta,$pdf->mesReporte); 
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
        $pdf->Cell(0,7,"CIERRE DE COMPROMISO [ $grupoCCValor% ]",0,1,'C',1); 

        // Listar Resultados RS
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDCC($pdf->asesorConsulta,$pdf->mesReporte); 
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
        $resultadoNota = $objetoGenerarPDFD->listarNotaDetalladoDCRS($pdf->asesorConsulta,$pdf->mesReporte); 
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
    $pdf->Output("I","informe-vd-detallado-negociacion-comercial-$pdf->mesReporte.pdf");   
    }
    else{
        header("location: retroalimentacionDao.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>