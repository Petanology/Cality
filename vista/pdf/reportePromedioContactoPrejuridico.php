<?php
    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validacionParaInformeDP($_GET["mesReporte"]);
    

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){

    require_once("../../modelo/liderDao.php");
    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalPDF-DP.php");
    require_once("../../controlador/arrayColumns.php");

    // Declaración de acumuladores
    $acumPromedioSET = 0;
    $acumPromedioNEG = 0;
    $acumPromedioNEG2 = 0;
    $acumPromedioRS = 0;
        
    $acumSETUnidades = 0;
    $acumNEGUnidades = 0;
    $acumNEG2Unidades = 0;
    $acumRSUnidades = 0;
        
    $acumTotalRankingG1 = 0;
    $acumTotalRankingG2 = 0;
    $acumTotalRankingG3 = 0;
    $acumTotalRankingG4 = 0;
    $acumTotalRankingG5 = 0;

    // Declaración de contador
    $contNumeroAsesores = 0;
    $cTotalUnidades = 0;
        
    $contTotalRankingG1 = 0;
    $contTotalRankingG2 = 0;
    $contTotalRankingG3 = 0;
    $contTotalRankingG4 = 0;
    $contTotalRankingG5 = 0;
        
    // Otras
    $grupoSETValor = 0;
    $grupoNEGValor = 0;
    $grupoNEG2Valor = 0;
    $grupoRSValor = 0;

    $pdf = new PDFDP('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
    // Varaibles generales
    $pdf->mes = $_GET["mesReporte"];
    $pdf->AliasNbPages();
    $pdf->AddPage();
        
    require_once("funcionesColorFondo.php");
    
    // Convenciones
    $pdf->SetFont('Arial','B',7);
    $pdf->SetDrawColor(52, 73, 94);
    
    $pdf->SetFillColor(77,108,140);
    $pdf->SetTextColor(255,255,255);
        
    $pdf->Cell(80,6,'CONVENCIONES',0,1,'C',1);
    
    $pdf->SetFillColor(214, 234, 248);
    $pdf->SetTextColor(44, 62, 80);
        
    $pdf->Cell(15,4,'SET',0,0,'C',1);
    $pdf->Cell(65,4,'  Servicio y etiqueta telefónica',0,1,'L',1);
    
    $pdf->Cell(15,4,'NEG',0,0,'C',1);
    $pdf->Cell(65,4,'  Negociación I',0,1,'L',1);
        
    $pdf->Cell(15,4,'NEG2',0,0,'C',1);
    $pdf->Cell(65,4,'  Negociación II',0,1,'L',1);
        
    $pdf->Cell(15,4,'RS',0,0,'C',1);
    $pdf->Cell(65,4,'  Registro en el sistema',0,1,'L',1);
    
    $pdf->Ln(7);
        
        
    // Titulo de promedio contacto directo
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(31,97,141);
    $pdf->SetDrawColor(31,97,141);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'PROMEDIO GRUPAL',1,1,'C',1);
    


    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);



    // Titulos tabla
    $pdf->Cell(70,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(25,6,'SET',0,0,'C',1); 
    $pdf->Cell(25,6,'NEG',0,0,'C',1);
    $pdf->Cell(25,6,'NEG2',0,0,'C',1);
    $pdf->Cell(25,6,'RS',0,0,'C',1);
    $pdf->Cell(26,6,'ACUMULADO',0,1,'C',1);    



    // Listar porcentajes del mes
    $objetoPDFDao = new generarPDFDao();
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDP($pdf->mes);

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
    
    $pdf->Cell(70,4,'- LÍDER -',0,0,'C',1); 
    $pdf->Cell(25,4,"$grupoSETValor%",0,0,'C',1); 
    $pdf->Cell(25,4,"$grupoNEGValor%",0,0,'C',1);
    $pdf->Cell(25,4,"$grupoNEG2Valor%",0,0,'C',1);
    $pdf->Cell(25,4,"$grupoRSValor%",0,0,'C',1);
    $pdf->Cell(26,4,"100%",0,1,'C',1);


    // Instancia a líder
    $objetoLiderDao = new liderDao();
    $rLiderDao = $objetoLiderDao->listarPromedioLiderDP($pdf->mes);

    // Instancia a Asesor
    $ojetoAsesorDao = new asesorDao();

    foreach($rLiderDao as $rowRLiderDao) {
        
        // Líderes de grupo
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(93, 109, 126);
        $pdf->Cell(70,6,$rowRLiderDao[0],0,0,'C',1);
        $pdf->Cell(25,6,$rowRLiderDao[1],0,0,'C',1); 
        $pdf->Cell(25,6,$rowRLiderDao[2],0,0,'C',1);
        $pdf->Cell(25,6,$rowRLiderDao[3],0,0,'C',1);
        $pdf->Cell(25,6,$rowRLiderDao[4],0,0,'C',1);
        $pdf->Cell(26,6,$rowRLiderDao[5],0,1,'C',1);

        
        $rAsesorDao = $ojetoAsesorDao->listarPromedioAsesorDP($pdf->mes,$rowRLiderDao[0]);
        
        foreach ($rAsesorDao as $rowRAsesorDao) {
           
            // Asesores
            $pdf->SetFillColor(214, 219, 223);
            $pdf->SetTextColor(28, 40, 51);
            $pdf->Cell(70,5,$rowRAsesorDao[0],0,0,'C',1);
            
            // Servicio y Etiqueta Telefónica        
            impresionColorClaro($grupoSETValor,$rowRAsesorDao[1]);       
            $pdf->Cell(25,5,$rowRAsesorDao[1],0,0,'C',1); 

            // Negociación I
            impresionColorClaro($grupoNEGValor,$rowRAsesorDao[2]);       
            $pdf->Cell(25,5,$rowRAsesorDao[2],0,0,'C',1);
            
            // Negociación II
            impresionColorClaro($grupoNEG2Valor,$rowRAsesorDao[3]);       
            $pdf->Cell(25,5,$rowRAsesorDao[3],0,0,'C',1);

            // Registro en el sistema
            impresionColorClaro($grupoRSValor,$rowRAsesorDao[4]);       
            $pdf->Cell(25,5,$rowRAsesorDao[4],0,0,'C',1);

            // Calculo para acumulador total general
            $pdf->SetTextColor(28, 40, 51);
            impresionColorOscuro($rowRAsesorDao[5]);       
            $pdf->Cell(26,5,$rowRAsesorDao[5],0,1,'C',1);
            
            // Acumuladores
            $acumPromedioSET += $rowRAsesorDao[1];
            $acumPromedioNEG += $rowRAsesorDao[2];
            $acumPromedioNEG2 += $rowRAsesorDao[3];
            $acumPromedioRS += $rowRAsesorDao[4];
            
            // Contadores
            $contNumeroAsesores ++;
            
            // Anulación de la consulta
            $rAsesorDao = null;

        }
    }

    // Cálculo de Seccion General
    $tGeneralSET = $acumPromedioSET / $contNumeroAsesores;
    $tGeneralNEG = $acumPromedioNEG / $contNumeroAsesores ;
    $tGeneralNEG2 = $acumPromedioNEG2 / $contNumeroAsesores ;
    $tGeneralRS = $acumPromedioRS / $contNumeroAsesores ;
    $tGeneral =  $tGeneralSET + $tGeneralNEG + $tGeneralNEG2 + $tGeneralRS;

    // Total General
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(70,8,'Total general',0,0,'C',1); 
    $pdf->Cell(25,8,round($tGeneralSET , 1),0,0,'C',1); 
    $pdf->Cell(25,8,round($tGeneralNEG , 1),0,0,'C',1);
    $pdf->Cell(25,8,round($tGeneralNEG2 , 1),0,0,'C',1);
    $pdf->Cell(25,8,round($tGeneralRS , 1),0,0,'C',1);
    $pdf->Cell(26,8,round($tGeneral , 1),0,1,'C',1);

    // Separador
    $pdf->AddPage();
    

    /* ************************************************ */
    /* ******************* UNIDADES ******************* */
    /* ************************************************ */


    // Titulo encabezado Ranking unidades
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(31,97,141);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE UNIDADES',1,1,'C',1);

    // Subtitulos respectivos
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(70,6,'UNIDADES',0,0,'C',1); 
    $pdf->Cell(25,6,'SET',0,0,'C',1); 
    $pdf->Cell(25,6,'NEG',0,0,'C',1);
    $pdf->Cell(25,6,'NEG2',0,0,'C',1);
    $pdf->Cell(25,6,'RS',0,0,'C',1);
    $pdf->Cell(26,6,'GENERAL',0,1,'C',1);
    $pdf->SetTextColor(28, 40, 51);


    // Instancia a unidad
    $oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidadDP($pdf->mes);

    foreach($resulORankUnidad as $rowResulORankUnidad){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(70,5,$rowResulORankUnidad[0],0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            impresionColorClaro($grupoSETValor,$rowResulORankUnidad[1]);
            $pdf->Cell(25,5,$rowResulORankUnidad[1],0,0,'C',1); 
            
            // Negociacion I
            impresionColorClaro($grupoNEGValor,$rowResulORankUnidad[2]);
            $pdf->Cell(25,5,$rowResulORankUnidad[2],0,0,'C',1);
            
            // Negociacion II
            impresionColorClaro($grupoNEG2Valor,$rowResulORankUnidad[3]);
            $pdf->Cell(25,5,$rowResulORankUnidad[3],0,0,'C',1);
        
            // Registro en el sistema
            impresionColorClaro($grupoRSValor,$rowResulORankUnidad[4]);
            $pdf->Cell(25,5,$rowResulORankUnidad[4],0,0,'C',1);
        
            // General
            $pdf->SetTextColor(28, 40, 51);
            impresionColorOscuro($rowResulORankUnidad[5]);
            $pdf->Cell(26,5,$rowResulORankUnidad[5],0,1,'C',1);
        
            $acumSETUnidades += $rowResulORankUnidad[1];
            $acumNEGUnidades += $rowResulORankUnidad[2];
            $acumNEG2Unidades += $rowResulORankUnidad[3];
            $acumRSUnidades += $rowResulORankUnidad[4];
            $cTotalUnidades++;
        
    } 

    $pUnidadesSET = $acumSETUnidades / $cTotalUnidades;
    $pUnidadesNEG = $acumNEGUnidades / $cTotalUnidades;
    $pUnidadesNEG2 = $acumNEG2Unidades / $cTotalUnidades;
    $pUnidadesRS = $acumRSUnidades / $cTotalUnidades;
    $tGeneralUnidades = $pUnidadesSET+$pUnidadesNEG+$pUnidadesNEG2+$pUnidadesRS;

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(70,7,'Promedio actual',0,0,'C',1); 
    $pdf->Cell(25,7,round($pUnidadesSET, 1),0,0,'C',1); 
    $pdf->Cell(25,7,round($pUnidadesNEG, 1),0,0,'C',1);
    $pdf->Cell(25,7,round($pUnidadesNEG2, 1),0,0,'C',1);
    $pdf->Cell(25,7,round($pUnidadesRS, 1),0,0,'C',1);
    $pdf->Cell(26,7,round($tGeneralUnidades, 1),0,1,'C',1);

    $pdf->SetFillColor(82, 103, 123);
    $pdf->Cell(70,7,'Adherencia',0,0,'C',1); 
    $pdf->Cell(25,7, round($pUnidadesSET * 100 / $grupoSETValor, 1) . '%',0,0,'C',1); 
    $pdf->Cell(25,7, round($pUnidadesNEG * 100 / $grupoNEGValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(25,7, round($pUnidadesNEG2 * 100 / $grupoNEG2Valor, 1) . '%',0,0,'C',1);
    $pdf->Cell(25,7, round($pUnidadesRS * 100 / $grupoRSValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(26,7, '- -' ,0,1,'C',1);

    // Separador
    $pdf->AddPage();

    /* ************************************** */
    /* ************************************** */
    /* ************************************** */



    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(28, 40, 51);
    $pdf->Cell(80,8,'ERRORES CRÍTICOS','B',1,'L',1);
    $pdf->Ln(3);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(31,97,141);
    $pdf->SetDrawColor(31,97,141);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'LISTA DE ASESORES QUE INFRINGIERON',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->SetTextColor(255,255,255);

    $pdf->Cell(75,6,'ASESOR',0,0,'C',1); 
    $pdf->Cell(0,6,'ERROR CRÍTICO',0,1,'C',1); 
 
    // UNIDADES
    $pdf->SetTextColor(28, 40, 51);
    $pdf->SetDrawColor(100,100,100);
    
    $erroresCriticosIDao = new errorCriticoDao();
    $rErroresCI = $erroresCriticosIDao->listarErroresCriticosInfringidosDP($pdf->mes);

    foreach($rErroresCI as $rowRErroresCI){
            // Nombre
            $pdf->SetFillColor(255,255,255);
            $pdf->Cell(75,5,$rowRErroresCI[0],'T',0,'C',1); 
            $pdf->SetFillColor(235, 237, 239);
            $pdf->MultiCell(0,5,$rowRErroresCI[1],'T','J',1); 
    } 

    $pdf->AddPage();

    // RANKING DE ERRORES CRITICOS

    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(31,97,141);
    $pdf->SetDrawColor(31,97,141);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING POR ERRORES CRÍTICOS INFRINGIDOS',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->SetTextColor(255,255,255);

    $pdf->Cell(30,6,'CANTIDAD',0,0,'C',1); 
    $pdf->Cell(0,6,'ERROR CRÍTICO',0,1,'C',1); 
 
    // UNIDADES
    $pdf->SetTextColor(28, 40, 51);
    $pdf->SetDrawColor(100,100,100);

    $objetoErrorCriticoDao = new errorCriticoDao();
    $rErrores = $objetoErrorCriticoDao->listarErroresCriticosDP($pdf->mes);
    
    $acumErroresCriticos = 0;

    foreach($rErrores as $rowRErrores){
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,$rowRErrores[0],'T',0,'C',0); 
        $pdf->SetFillColor(235, 237, 239);
        $pdf->MultiCell(0,5,$rowRErrores[1],'T','J',1);
        $acumErroresCriticos += $rowRErrores[0];
    }

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(30,8,$acumErroresCriticos,0,0,'C',1); 
    $pdf->Cell(0,8,'TOTAL DE ERRORES CRÍTICOS',0,0,'L',1); 
     
    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","informe-negociacion-prejuridica-$pdf->mes.pdf");
        
    }
    else{
        header("location: indexReporteDP.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>



































