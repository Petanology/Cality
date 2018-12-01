<?php
    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validarResultadosParaInforme($_POST["mesReporte"]);
    

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){
    /*  COLORES:
        ___________________________________________________
        |  - - - - -  |  Claros         |  Oscuros         |
        |  verde      |  130, 224, 170  |  88, 214, 141    |
        |  amarillo   |  249, 231, 159  |  247, 220, 111   |
        |  rojo       |  236, 112, 99   |  231, 76, 60     |
        ---------------------------------------------------    
    */

    require_once("../../modelo/liderDao.php");
    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalPDF-DC.php");

    // Declaración de acumuladores
    $acumPromedioSET = 0;
    $acumPromedioNEG = 0;
    $acumPromedioRS = 0;
    $acumSETUnidades = 0;
    $acumNEGUnidades = 0;
    $acumRSUnidades = 0;

    // Declaración de contador
    $contNumeroAsesores = 0;
    $cTotalUnidades = 0;

    $pdf = new PDF('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
    // Varaibles generales
    $pdf->mes = $_POST["mesReporte"];
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Titulo de promedio contacto directo
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(46, 134, 193);
    $pdf->SetDrawColor(46, 134, 193);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'PROMEDIO CONTACTO DIRECTO',1,1,'C',1);
    


    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);



    // Titulos tabla
    $pdf->Cell(51,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(55,6,'SERVICIO Y ETIQUETA TELEFÓNICA',0,0,'C',1); 
    $pdf->Cell(25,6,'NEGOCIACIÓN',0,0,'C',1);
    $pdf->Cell(41,6,'REGISTRO EN EL SISTEMA',0,0,'C',1);
    $pdf->Cell(24,6,'ACUMULADO',0,1,'C',1);    



    // Listar porcentajes del mes
    $objetoPDFDao = new generarPDFDao();
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDC($pdf->mes);

    foreach($rValorPDF as $rowRV){
        $pdf->Cell(51,4,'- LÍDER -',0,0,'C',1); 
        $pdf->Cell(55,4,"$rowRV[0]%",0,0,'C',1); 
        $pdf->Cell(25,4,"$rowRV[1]%",0,0,'C',1);
        $pdf->Cell(41,4,"$rowRV[2]%",0,0,'C',1);
        $pdf->Cell(24,4,$rowRV[0]+$rowRV[1]+$rowRV[2] ."%",0,1,'C',1);
        
        // Anulación de la consulta
        $rValorPDF = null;
    }   


    // Instancia a líder
    $objetoLiderDao = new liderDao();
    $rLiderDao = $objetoLiderDao->listarPromedioLider($pdf->mes);

    // Instancia a Asesor
    $ojetoAsesorDao = new asesorDao();

    foreach($rLiderDao as $rowRLiderDao) {
        
        // Líderes de grupo
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(93, 109, 126);
        
        $pdf->Cell(51,6,$rowRLiderDao[0],0,0,'C',1);
        $pdf->Cell(55,6,$rowRLiderDao[1],0,0,'C',1); 
        $pdf->Cell(25,6,$rowRLiderDao[2],0,0,'C',1);
        $pdf->Cell(41,6,$rowRLiderDao[3],0,0,'C',1);
        $pdf->Cell(24,6,$rowRLiderDao[4],0,1,'C',1);

        
        $rAsesorDao = $ojetoAsesorDao->listarPromedioAsesor($pdf->mes,$rowRLiderDao[0]);
        
        foreach ($rAsesorDao as $rowRAsesorDao) {
            
            // Asesores
            $pdf->SetFillColor(214, 219, 223);
            $pdf->SetTextColor(28, 40, 51);
            
            $pdf->Cell(51,5,$rowRAsesorDao[0],0,0,'C',1);
            
            // Servicio y Etiqueta Telefónica
            $pdf->SetFillColor(130, 224, 170);          
            $pdf->Cell(55,5,$rowRAsesorDao[1],0,0,'C',1); 

            // Negociación
            $pdf->SetFillColor(249, 231, 159);
            $pdf->Cell(25,5,$rowRAsesorDao[2],0,0,'C',1);

            // Registro en el sistema
            $pdf->SetFillColor(236, 112, 99);
            $pdf->Cell(41,5,$rowRAsesorDao[3],0,0,'C',1);

            // Calculo subtotal de asesor
            $resultadoAsesor = $rowRAsesorDao[1]+$rowRAsesorDao[2]+$rowRAsesorDao[3];
                
            // Calculo para acumulador total general
            $pdf->SetFillColor(231, 76, 60);
            $pdf->Cell(24,5,$resultadoAsesor,0,1,'C',1);
            
            // Acumuladores
            $acumPromedioSET += $rowRAsesorDao[1];
            $acumPromedioNEG += $rowRAsesorDao[2];
            $acumPromedioRS += $rowRAsesorDao[3];
            
            // Contadores
            $contNumeroAsesores ++;
            
            // Anulación de la consulta
            $rAsesorDao = null;

        }
    }

    // Cálculo de Seccion General
    $tGeneralSET = $acumPromedioSET / $contNumeroAsesores;
    $tGeneralNEG = $acumPromedioNEG / $contNumeroAsesores ;
    $tGeneralRS = $acumPromedioRS / $contNumeroAsesores ;
    $tGeneral =  $tGeneralSET + $tGeneralNEG + $tGeneralRS;

    // Total General
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(51,8,'Total general',0,0,'C',1); 
    $pdf->Cell(55,8,round($tGeneralSET , 1),0,0,'C',1); 
    $pdf->Cell(25,8,round($tGeneralNEG , 1),0,0,'C',1);
    $pdf->Cell(41,8,round($tGeneralRS , 1),0,0,'C',1);
    $pdf->Cell(24,8,round($tGeneral , 1),0,1,'C',1);

    // Separador
    $pdf->AddPage();
    

    /* ************************************************ */
    /* ******************* UNIDADES ******************* */
    /* ************************************************ */


    // Titulo encabezado Ranking unidades
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(46, 134, 193);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE UNIDADES',1,1,'C',1);

    // Subtitulos respectivos
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(51,6,'UNIDADES',0,0,'C',1); 
    $pdf->Cell(55,6,'SERVICIO Y ETIQUETA TELEFÓNICA',0,0,'C',1); 
    $pdf->Cell(25,6,'NEGOCIACIÓN',0,0,'C',1);
    $pdf->Cell(41,6,'REGISTRO EN EL SISTEMA',0,0,'C',1);
    $pdf->Cell(24,6,'GENERAL',0,1,'C',1);
    $pdf->SetTextColor(28, 40, 51);


    // Instancia a unidad
    $oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidad($pdf->mes);

    foreach($resulORankUnidad as $rowResulORankUnidad){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(51,5,$rowResulORankUnidad[0],0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            $pdf->SetFillColor(130, 224, 170);
            $pdf->Cell(55,5,$rowResulORankUnidad[1],0,0,'C',1); 
            
            $pdf->SetFillColor(249, 231, 159);
            $pdf->Cell(25,5,$rowResulORankUnidad[2],0,0,'C',1);
            
            $pdf->SetFillColor(236, 112, 99);
            $pdf->Cell(41,5,$rowResulORankUnidad[3],0,0,'C',1);
        
            $pdf->SetFillColor(231, 76, 60);
            $pdf->Cell(24,5,$rowResulORankUnidad[4],0,1,'C',1);
        
            $acumSETUnidades += $rowResulORankUnidad[1];
            $acumNEGUnidades += $rowResulORankUnidad[2];
            $acumRSUnidades += $rowResulORankUnidad[3];
            $cTotalUnidades++;
        
    } 

    $pUnidadesSET = $acumSETUnidades / $cTotalUnidades;
    $pUnidadesNEG = $acumNEGUnidades / $cTotalUnidades;
    $pUnidadesRS = $acumRSUnidades / $cTotalUnidades;
    $tGeneralUnidades = $pUnidadesSET+$pUnidadesNEG+$pUnidadesRS;

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(51,7,'Promedio actual',0,0,'C',1); 
    $pdf->Cell(55,7,round($pUnidadesSET, 1),0,0,'C',1); 
    $pdf->Cell(25,7,round($pUnidadesNEG, 1),0,0,'C',1);
    $pdf->Cell(41,7,round($pUnidadesRS, 1),0,0,'C',1);
    $pdf->Cell(24,7,round($tGeneralUnidades, 1),0,1,'C',1);


    // Adherencia
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDC($pdf->mes);

    foreach($rValorPDF as $rowRV){
        
        $pdf->SetFillColor(82, 103, 123);
        $pdf->Cell(51,7,'Adherencia',0,0,'C',1); 
        $pdf->Cell(55,7, round($pUnidadesSET * 100 / $rowRV[0] , 1) . '%',0,0,'C',1); 
        $pdf->Cell(25,7, round($pUnidadesNEG * 100 / $rowRV[1] , 1) . '%',0,0,'C',1);
        $pdf->Cell(41,7, round($pUnidadesRS * 100 / $rowRV[2] , 1) . '%',0,0,'C',1);
        $pdf->Cell(24,7, '- -' ,0,1,'C',1);
        
    }   

    // Separador
    $pdf->AddPage();



    /* ************************************** */
    /* ************************************** */
    /* ************************************** */



    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(46, 134, 193);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE ASESORES',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->Cell(91,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(25,6,'GESTIÓN 1',0,0,'C',1); 
    $pdf->Cell(25,6,'GESTIÓN 2',0,0,'C',1);
    $pdf->Cell(25,6,'GESTIÓN 3',0,0,'C',1);
    $pdf->Cell(30,6,'TOTAL GENERAL',0,1,'C',1);

        
    // Instancia a unidad
    /*$oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidad($pdf->mes);

    foreach($resulORankUnidad as $rowResulORankUnidad){
    */
    
    // Asesores ranking
    $pdf->SetTextColor(28, 40, 51);

    for($is = 0; $is<100; $is++){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(91,5,'Diana Yubeli Sarmiento Perez',0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            $pdf->SetFillColor(130, 224, 170);
            $pdf->Cell(25,5,'27',0,0,'C',1); 
            
            $pdf->SetFillColor(249, 231, 159);
            $pdf->Cell(25,5,'46',0,0,'C',1);
            
            $pdf->SetFillColor(236, 112, 99);
            $pdf->Cell(25,5,'20',0,0,'C',1);
            
            $pdf->SetFillColor(231, 76, 60);
            $pdf->Cell(30,5,'93',0,1,'C',1);
            
    } 


    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Total General
    $pdf->Cell(51,5,'Total General',0,0,'C',1); 
    $pdf->Cell(55,5,'85',0,0,'C',1); 
    $pdf->Cell(25,5,'84',0,0,'C',1);
    $pdf->Cell(41,5,'88',0,0,'C',1);
    $pdf->Cell(24,5,'86',0,1,'C',1);

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
    $pdf->SetFillColor(231, 76, 60);
    $pdf->SetDrawColor(231, 76, 60);
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
    $rErroresCI = $erroresCriticosIDao->listarErroresCriticosInfringidos($pdf->mes);

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
    $pdf->SetFillColor(231, 76, 60);
    $pdf->SetDrawColor(231, 76, 60);
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

    $objetoErrorCriticoDCDao = new errorCriticoDao();
    $rErroresDC = $objetoErrorCriticoDCDao->listarErroresCriticosDC($pdf->mes);
    
    $acumErroresCriticos = 0;

    foreach($rErroresDC as $rowRErroresDC){
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,$rowRErroresDC[0],'T',0,'C',0); 
        $pdf->SetFillColor(235, 237, 239);
        $pdf->MultiCell(0,5,$rowRErroresDC[1],'T','J',1);
        $acumErroresCriticos += $rowRErroresDC[0];
    }

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(30,8,$acumErroresCriticos,0,0,'C',1); 
    $pdf->Cell(0,8,'TOTAL DE ERRORES CRÍTICOS',0,0,'L',1); 
     
    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","informe-venta-directa-$pdf->mes.pdf");
        
    }
    else{
        header("location: indexReporteDC.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>



































