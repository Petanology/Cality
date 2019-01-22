<?php
    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validacionParaInformeIB($_GET["mesReporte"]);
    

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){

    require_once("../../modelo/liderDao.php");
    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalPDF-IB.php");
    require_once("../../controlador/arrayColumns.php");

    // Declaración de acumuladores
    $acumPromedioSET = 0;
    $acumPromedioOLL = 0;
    $acumPromedioRS = 0;
        
    $acumSETUnidades = 0;
    $acumOLLUnidades = 0;
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
    $grupoOLLValor = 0;
    $grupoRSValor = 0;

    $pdf = new PDFIB('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
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
    
    $pdf->Cell(15,4,'OLL',0,0,'C',1);
    $pdf->Cell(65,4,'  Objeto de la llamada I',0,1,'L',1);
        
    $pdf->Cell(15,4,'RS',0,0,'C',1);
    $pdf->Cell(65,4,'  Registro en el sistema',0,1,'L',1);
    
    $pdf->Ln(7);
        
    // Titulo de promedio contacto directo
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(52,73,94);
    $pdf->SetDrawColor(52,73,94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'PROMEDIO GRUPAL',1,1,'C',1);
    


    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);



    // Titulos tabla
    $pdf->Cell(70,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(30,6,'SET',0,0,'C',1); 
    $pdf->Cell(30,6,'OLL',0,0,'C',1);
    $pdf->Cell(30,6,'RS',0,0,'C',1);
    $pdf->Cell(36,6,'ACUMULADO',0,1,'C',1);    



    // Listar porcentajes del mes
    $objetoPDFDao = new generarPDFDao();
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoIB($pdf->mes);

    foreach($rValorPDF as $rowRV){
        global $grupoSETValor; 
        global $grupoOLLValor; 
        global $grupoRSValor; 
        
        $grupoSETValor = $rowRV[0];
        $grupoOLLValor = $rowRV[1];
        $grupoRSValor = $rowRV[2];
    }
    
    $pdf->Cell(70,4,'- LÍDER -',0,0,'C',1); 
    $pdf->Cell(30,4,"$grupoSETValor%",0,0,'C',1); 
    $pdf->Cell(30,4,"$grupoOLLValor%",0,0,'C',1);
    $pdf->Cell(30,4,"$grupoRSValor%",0,0,'C',1);
    $pdf->Cell(36,4,$rowRV[0]+$rowRV[1]+$rowRV[2] ."%",0,1,'C',1);


    // Instancia a líder
    $objetoLiderDao = new liderDao();
    $rLiderDao = $objetoLiderDao->listarPromedioLiderIB($pdf->mes);

    // Instancia a Asesor
    $ojetoAsesorDao = new asesorDao();

    foreach($rLiderDao as $rowRLiderDao) {
        
        // Líderes de grupo
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(50,62,75);
        $pdf->Cell(70,6,$rowRLiderDao[0],0,0,'C',1);
        $pdf->Cell(30,6,$rowRLiderDao[1],0,0,'C',1); 
        $pdf->Cell(30,6,$rowRLiderDao[2],0,0,'C',1);
        $pdf->Cell(30,6,$rowRLiderDao[3],0,0,'C',1);
        $pdf->Cell(36,6,$rowRLiderDao[4],0,1,'C',1);

        
        $rAsesorDao = $ojetoAsesorDao->listarPromedioAsesorIB($pdf->mes,$rowRLiderDao[0]);
        
        foreach ($rAsesorDao as $rowRAsesorDao) {
           
            // Asesores
            $pdf->SetFillColor(214, 219, 223);
            $pdf->SetTextColor(28, 40, 51);
            $pdf->Cell(70,5,$rowRAsesorDao[0],0,0,'C',1);
            
            // Servicio y Etiqueta Telefónica        
            impresionColorClaro($grupoSETValor,$rowRAsesorDao[1]);       
            $pdf->Cell(30,5,$rowRAsesorDao[1],0,0,'C',1); 

            // Objeto de la llamada
            impresionColorClaro($grupoOLLValor,$rowRAsesorDao[2]);       
            $pdf->Cell(30,5,$rowRAsesorDao[2],0,0,'C',1);

            // Registro en el sistema
            impresionColorClaro($grupoRSValor,$rowRAsesorDao[3]);       
            $pdf->Cell(30,5,$rowRAsesorDao[3],0,0,'C',1);

            $pdf->SetTextColor(28, 40, 51);
            // Calculo para acumulador total general
            impresionColorOscuro($rowRAsesorDao[4]);       
            $pdf->Cell(36,5,$rowRAsesorDao[4],0,1,'C',1);
            
            // Acumuladores
            $acumPromedioSET += $rowRAsesorDao[1];
            $acumPromedioOLL += $rowRAsesorDao[2];
            $acumPromedioRS += $rowRAsesorDao[3];
            
            // Contadores
            $contNumeroAsesores ++;
            
            // Anulación de la consulta
            $rAsesorDao = null;

        }
    }

    // Cálculo de Seccion General
    $tGeneralSET = $acumPromedioSET / $contNumeroAsesores;
    $tGeneralOLL = $acumPromedioOLL / $contNumeroAsesores ;
    $tGeneralRS = $acumPromedioRS / $contNumeroAsesores ;
    $tGeneral =  $tGeneralSET + $tGeneralOLL + $tGeneralRS;

    // Total General
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(70,8,'Total general',0,0,'C',1); 
    $pdf->Cell(30,8,round($tGeneralSET , 1),0,0,'C',1); 
    $pdf->Cell(30,8,round($tGeneralOLL , 1),0,0,'C',1);
    $pdf->Cell(30,8,round($tGeneralRS , 1),0,0,'C',1);
    $pdf->Cell(36,8,round($tGeneral , 1),0,1,'C',1);

    // Separador
    $pdf->AddPage();
    

    /* ************************************************ */
    /* ******************* UNIDADES ******************* */
    /* ************************************************ */


    // Titulo encabezado Ranking unidades
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(52,73,94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE UNIDADES',1,1,'C',1);

    // Subtitulos respectivos
    $pdf->SetFillColor(50,62,75);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(70,6,'UNIDADES',0,0,'C',1); 
    $pdf->Cell(30,6,'SET',0,0,'C',1); 
    $pdf->Cell(30,6,'OLL',0,0,'C',1);
    $pdf->Cell(30,6,'RS',0,0,'C',1);
    $pdf->Cell(36,6,'GENERAL',0,1,'C',1);
    $pdf->SetTextColor(28, 40, 51);


    // Instancia a unidad
    $oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidadIB($pdf->mes);

    foreach($resulORankUnidad as $rowResulORankUnidad){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(70,5,$rowResulORankUnidad[0],0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            impresionColorClaro($grupoSETValor,$rowResulORankUnidad[1]);
            $pdf->Cell(30,5,$rowResulORankUnidad[1],0,0,'C',1); 
            
            impresionColorClaro($grupoOLLValor,$rowResulORankUnidad[2]);
            $pdf->Cell(30,5,$rowResulORankUnidad[2],0,0,'C',1);
            
            impresionColorClaro($grupoRSValor,$rowResulORankUnidad[3]);
            $pdf->Cell(30,5,$rowResulORankUnidad[3],0,0,'C',1);

            $pdf->SetTextColor(28, 40, 51);
            impresionColorOscuro($rowResulORankUnidad[4]);
            $pdf->Cell(36,5,$rowResulORankUnidad[4],0,1,'C',1);
        
            $acumSETUnidades += $rowResulORankUnidad[1];
            $acumOLLUnidades += $rowResulORankUnidad[2];
            $acumRSUnidades += $rowResulORankUnidad[3];
            $cTotalUnidades++;
        
    } 

    $pUnidadesSET = $acumSETUnidades / $cTotalUnidades;
    $pUnidadesOLL = $acumOLLUnidades / $cTotalUnidades;
    $pUnidadesRS = $acumRSUnidades / $cTotalUnidades;
    $tGeneralUnidades = $pUnidadesSET+$pUnidadesOLL+$pUnidadesRS;

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(70,7,'Promedio actual',0,0,'C',1); 
    $pdf->Cell(30,7,round($pUnidadesSET, 1),0,0,'C',1); 
    $pdf->Cell(30,7,round($pUnidadesOLL, 1),0,0,'C',1);
    $pdf->Cell(30,7,round($pUnidadesRS, 1),0,0,'C',1);
    $pdf->Cell(36,7,round($tGeneralUnidades, 1),0,1,'C',1);

    $pdf->SetFillColor(82, 103, 123);
    $pdf->Cell(70,7,'Adherencia',0,0,'C',1); 
    $pdf->Cell(30,7, round($pUnidadesSET * 100 / $grupoSETValor, 1) . '%',0,0,'C',1); 
    $pdf->Cell(30,7, round($pUnidadesOLL * 100 / $grupoOLLValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(30,7, round($pUnidadesRS * 100 / $grupoRSValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(36,7, '- -' ,0,1,'C',1);

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
    $pdf->SetFillColor(52,73,94);
    $pdf->SetDrawColor(52,73,94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'LISTA DE ASESORES QUE INFRINGIERON',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(50,62,75);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->SetTextColor(255,255,255);

    $pdf->Cell(75,6,'ASESOR',0,0,'C',1); 
    $pdf->Cell(0,6,'ERROR CRÍTICO',0,1,'C',1); 
 
    // UNIDADES
    $pdf->SetTextColor(28, 40, 51);
    $pdf->SetDrawColor(100,100,100);
    
    $erroresCriticosIDao = new errorCriticoDao();
    $rErroresCI = $erroresCriticosIDao->listarErroresCriticosInfringidosIB($pdf->mes);

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
    $pdf->SetFillColor(52,73,94);
    $pdf->SetDrawColor(52,73,94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING POR ERRORES CRÍTICOS INFRINGIDOS',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(50,62,75);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->SetTextColor(255,255,255);

    $pdf->Cell(30,6,'CANTIDAD',0,0,'C',1); 
    $pdf->Cell(0,6,'ERROR CRÍTICO',0,1,'C',1); 
 
    // UNIDADES
    $pdf->SetTextColor(28, 40, 51);
    $pdf->SetDrawColor(100,100,100);

    $objetoErrorCriticoIBDao = new errorCriticoDao();
    $rErroresIB = $objetoErrorCriticoIBDao->listarErroresCriticosIB($pdf->mes);
    
    $acumErroresCriticos = 0;

    foreach($rErroresIB as $rowRErroresIB){
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,$rowRErroresIB[0],'T',0,'C',0); 
        $pdf->SetFillColor(235, 237, 239);
        $pdf->MultiCell(0,5,$rowRErroresIB[1],'T','J',1);
        $acumErroresCriticos += $rowRErroresIB[0];
    }

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(30,8,$acumErroresCriticos,0,0,'C',1); 
    $pdf->Cell(0,8,'TOTAL DE ERRORES CRÍTICOS',0,0,'L',1); 
     
    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","informe-inbound-vd-$pdf->mes.pdf");
        
    }
    else{
        header("location: indexReporteIB.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>



































