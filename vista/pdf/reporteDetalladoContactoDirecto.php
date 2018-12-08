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
        
    // Otras
    $grupoSETValor = 0;
    $grupoNEGValor = 0;
    $grupoRSValor = 0;

    $pdf = new PDF('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
    // Varaibles generales
    $pdf->mes = $_POST["mesReporte"];
    $pdf->AliasNbPages();
    $pdf->AddPage();
        
    function sort_by_orden($a, $b) {
        return $b[4] - $a[4];
    }
    
    
    // Calcular Promedio C-Directo
    function impresionColorOscuro($nResultado){
        global $pdf;
        if($nResultado >= 0 && $nResultado <= 68){
            $pdf->SetFillColor(231, 76, 60);
        } else if($nResultado >= 69 && $nResultado <= 84){
            $pdf->SetFillColor(247, 220, 111);
        } else if($nResultado >= 85 && $nResultado <= 100){
            $pdf->SetFillColor(88, 214, 141);
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }
    }

        
    // Calcular Totales Claros
    function impresionColorRankingA($nResultado){
        global $pdf;
        if($nResultado >= 0 && $nResultado <= 68){
            $pdf->SetFillColor(236, 112, 99);
        } else if($nResultado >= 69 && $nResultado <= 84){
            $pdf->SetFillColor(249, 231, 159);
        } else if($nResultado >= 85 && $nResultado <= 100){
            $pdf->SetFillColor(130, 224, 170);
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }
    }
        
    // Calcular y aplciar color de fondo para grupo de items
    function impresionColorClaro($maximo,$nResultado){
        global $pdf;
        
        $indicadorMaximo = $maximo;
        $indicadorRojo = 69 * $indicadorMaximo / 100;
        $indicadorAmarillo = 85 * $indicadorMaximo / 100;
        
        if($nResultado >= 0 && $nResultado < $indicadorRojo){
            
            $pdf->SetFillColor(236, 112, 99);
            
        } else if($nResultado >= $indicadorRojo && $nResultado < $indicadorAmarillo){
            
            $pdf->SetFillColor(249, 231, 159);
            
        } else if($nResultado >= $indicadorAmarillo && $nResultado <= $indicadorMaximo){
            
            $pdf->SetFillColor(130, 224, 170);
            
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }

    }

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
        global $grupoSETValor; 
        global $grupoNEGValor; 
        global $grupoRSValor; 
        
        $grupoSETValor = $rowRV[0];
        $grupoNEGValor = $rowRV[1];
        $grupoRSValor = $rowRV[2];
    }
    
    $pdf->Cell(51,4,'- LÍDER -',0,0,'C',1); 
    $pdf->Cell(55,4,"$grupoSETValor%",0,0,'C',1); 
    $pdf->Cell(25,4,"$grupoNEGValor%",0,0,'C',1);
    $pdf->Cell(41,4,"$grupoRSValor%",0,0,'C',1);
    $pdf->Cell(24,4,$rowRV[0]+$rowRV[1]+$rowRV[2] ."%",0,1,'C',1);


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
            impresionColorClaro($grupoSETValor,$rowRAsesorDao[1]);       
            $pdf->Cell(55,5,$rowRAsesorDao[1],0,0,'C',1); 

            // Negociación
            impresionColorClaro($grupoNEGValor,$rowRAsesorDao[2]);       
            $pdf->Cell(25,5,$rowRAsesorDao[2],0,0,'C',1);

            // Registro en el sistema
            impresionColorClaro($grupoRSValor,$rowRAsesorDao[3]);       
            $pdf->Cell(41,5,$rowRAsesorDao[3],0,0,'C',1);

            // Calculo para acumulador total general
            impresionColorOscuro($rowRAsesorDao[4]);       
            $pdf->Cell(24,5,$rowRAsesorDao[4],0,1,'C',1);
            
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
            impresionColorClaro($grupoSETValor,$rowRAsesorDao[1]);
            $pdf->Cell(55,5,$rowResulORankUnidad[1],0,0,'C',1); 
            
            impresionColorClaro($grupoNEGValor,$rowRAsesorDao[2]);
            $pdf->Cell(25,5,$rowResulORankUnidad[2],0,0,'C',1);
            
            impresionColorClaro($grupoRSValor,$rowRAsesorDao[3]);
            $pdf->Cell(41,5,$rowResulORankUnidad[3],0,0,'C',1);
        
            impresionColorOscuro($rowRAsesorDao[4]);
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

    $pdf->SetFillColor(82, 103, 123);
    $pdf->Cell(51,7,'Adherencia',0,0,'C',1); 
    $pdf->Cell(55,7, round($pUnidadesSET * 100 / $grupoSETValor, 1) . '%',0,0,'C',1); 
    $pdf->Cell(25,7, round($pUnidadesNEG * 100 / $grupoNEGValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(41,7, round($pUnidadesRS * 100 / $grupoRSValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(24,7, '- -' ,0,1,'C',1);

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
    $pdf->Cell(30,6,'TOTAL',0,1,'C',1);

    // Instancia a Asesor
    $oRankAsesor = new asesorDao();
    $rRankingAsesor = $oRankAsesor->listarRankingAsesor($pdf->mes);
        
    $asesores = array();
    
    // Asesores ranking
    $pdf->SetTextColor(28, 40, 51);
    foreach($rRankingAsesor as $ConsultaRA){
        $resultado = array_search($ConsultaRA[0] , array_column($asesores , 0));
        if(is_numeric($resultado)) {
            array_push(
                $asesores[$resultado],
                $ConsultaRA[1]
            );
        } else {
            array_push(
                $asesores,
                [
                    0 => $ConsultaRA[0],
                    1 => $ConsultaRA[1],
                ]
            );
        }
    }
        
        
    // Recorrido para asignar total por asesor    
    for($x=0; $x<count($asesores); $x++){
        
        $subtotal = 0;
        $totalGestiones = count($asesores[$x]) - 1;
        
        for($i=1; $i<count($asesores[$x]); $i++){
            
            $subtotal += $asesores[$x][$i];   
            
        }
                 
        $asesores[$x][4] = round($subtotal / $totalGestiones , 1);
        
    }
        
         
    uasort($asesores, 'sort_by_orden');
            
    // Recorrido para impresion
    foreach($asesores as $rowAsesores){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(91,5,$rowAsesores[0],0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            if(isset($rowAsesores[1])){
                impresionColorRankingA($rowAsesores[1]);
                $pdf->Cell(25,5,$rowAsesores[1],0,0,'C',1); 
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1); 
            }
        
            // Negociación    
            if(isset($rowAsesores[2])){
                impresionColorRankingA($rowAsesores[2]);
                $pdf->Cell(25,5,$rowAsesores[2],0,0,'C',1);
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
            
        
            // Registro en el sistema
            if(isset($rowAsesores[3])){
                impresionColorRankingA($rowAsesores[3]);
                $pdf->Cell(25,5,$rowAsesores[3],0,0,'C',1);
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
        
            // Total
            if(isset($rowAsesores[4])){
                impresionColorOscuro($rowAsesores[4]);
                $pdf->Cell(30,5,$rowAsesores[4] . "%",0,1,'C',1);
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(30,5,"",0,1,'C',1);
            }
    } 


    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Total General
    $pdf->Cell(91,7,'ACUMULADO TOTAL',0,0,'C',1); 
    $pdf->Cell(25,7,'85',0,0,'C',1); 
    $pdf->Cell(25,7,'84',0,0,'C',1);
    $pdf->Cell(25,7,'88',0,0,'C',1);
    $pdf->Cell(30,7,'86',0,1,'C',1);

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


































