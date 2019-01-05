<?php
    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validacionParaInformeNEG($_POST["mesReporte"]);
    

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){

    require_once("../../modelo/liderDao.php");
    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalPDF-NEG.php");

    // Declaración de acumuladores
    
    $acumPromedioPEP = 0;
    $acumPromedioSC = 0;
    $acumPromedioN = 0;
    $acumPromedioAD = 0;
    $acumPromedioRS = 0;
        
    $acumPEPUnidades = 0;
    $acumSCUnidades = 0;
    $acumNUnidades = 0;
    $acumADUnidades = 0;
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
        
    $grupoPEPValor = 0;
    $grupoSCValor = 0;
    $grupoNValor = 0;
    $grupoADValor = 0;
    $grupoRSValor = 0;

    $pdf = new PDFNEG('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
    // Varaibles generales
    $pdf->mes = $_POST["mesReporte"];
    $pdf->AliasNbPages();
    $pdf->AddPage();
        
    function sort_by_orden($a, $b) {
        return $b[5] - $a[5];
    }
        
    require_once("funcionesColorFondo.php");

    // Convenciones
    $pdf->SetFont('Arial','B',7);
    $pdf->SetDrawColor(52, 73, 94);
    
    $pdf->SetFillColor(77,108,140);
    $pdf->SetTextColor(255,255,255);
        
    $pdf->Cell(80,6,'CONVENCIONES',0,1,'C',1);
    
    $pdf->SetFillColor(214, 234, 248);
    $pdf->SetTextColor(44, 62, 80);
        
    $pdf->Cell(15,4,'PEP',0,0,'C',1);
    $pdf->Cell(65,4,'  Protocolo y etiqueta profesional',0,1,'L',1);
    
    $pdf->Cell(15,4,'SC',0,0,'C',1);
    $pdf->Cell(65,4,'  Servicio al cliente',0,1,'L',1);
        
    $pdf->Cell(15,4,'NEG',0,0,'C',1);
    $pdf->Cell(65,4,'  Negociación',0,1,'L',1);
        
    $pdf->Cell(15,4,'AD',0,0,'C',1);
    $pdf->Cell(65,4,'  Actualizacion de datos',0,1,'L',1);

    $pdf->Cell(15,4,'RS',0,0,'C',1);
    $pdf->Cell(65,4,'  Registro en el sistema',0,1,'L',1);

    $pdf->Ln(7);
        
    // Titulo de promedio contacto directo
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(84,153,199);
    $pdf->SetDrawColor(84,153,199);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'PROMEDIO GRUPAL',1,1,'C',1);
    


    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);



    // Titulos tabla
    $pdf->Cell(51,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(25,6,'PEP',0,0,'C',1); 
    $pdf->Cell(24,6,'SC',0,0,'C',1);
    $pdf->Cell(24,6,'NEG',0,0,'C',1);
    $pdf->Cell(24,6,'AD',0,0,'C',1);
    $pdf->Cell(24,6,'RS',0,0,'C',1);
    $pdf->Cell(24,6,'ACUMULADO',0,1,'C',1);


    // Listar porcentajes del mes
    $objetoPDFDao = new generarPDFDao();
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoNEG($pdf->mes);

    foreach($rValorPDF as $rowRV){
        global $grupoPEPValor; 
        global $grupoSCValor; 
        global $grupoNValor; 
        global $grupoADValor; 
        global $grupoRSValor; 
        
        $grupoPEPValor = $rowRV[0];
        $grupoSCValor = $rowRV[1];
        $grupoNValor = $rowRV[2];
        $grupoADValor = $rowRV[3];
        $grupoRSValor = $rowRV[4];
    }
    
    $pdf->Cell(51,4,'- LÍDER -',0,0,'C',1); 
    $pdf->Cell(25,4,"$grupoPEPValor%",0,0,'C',1); 
    $pdf->Cell(24,4,"$grupoSCValor%",0,0,'C',1);
    $pdf->Cell(24,4,"$grupoNValor%",0,0,'C',1);
    $pdf->Cell(24,4,"$grupoADValor%",0,0,'C',1);
    $pdf->Cell(24,4,"$grupoRSValor%",0,0,'C',1);
    $pdf->Cell(24,4,$rowRV[0]+$rowRV[1]+$rowRV[2]+$rowRV[3]+$rowRV[4] ."%",0,1,'C',1);


    // Instancia a líder
    $objetoLiderDao = new liderDao();
    $rLiderDao = $objetoLiderDao->listarPromedioLiderNEG($pdf->mes);

    // Instancia a Asesor
    $ojetoAsesorDao = new asesorDao();

    foreach($rLiderDao as $rowRLiderDao) {
        
        // Líderes de grupo
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(93, 109, 126);
        $pdf->Cell(51,6,$rowRLiderDao[0],0,0,'C',1);
        $pdf->Cell(25,6,$rowRLiderDao[1],0,0,'C',1); 
        $pdf->Cell(24,6,$rowRLiderDao[2],0,0,'C',1);
        $pdf->Cell(24,6,$rowRLiderDao[3],0,0,'C',1);
        $pdf->Cell(24,6,$rowRLiderDao[4],0,0,'C',1);
        $pdf->Cell(24,6,$rowRLiderDao[5],0,0,'C',1);
        $pdf->Cell(24,6,$rowRLiderDao[6],0,1,'C',1);
        
        $rAsesorDao = $ojetoAsesorDao->listarPromedioAsesorNEG($pdf->mes,$rowRLiderDao[0]);
        
        foreach ($rAsesorDao as $rowRAsesorDao) {
           
            // Asesores
            $pdf->SetFillColor(214, 219, 223);
            $pdf->SetTextColor(28, 40, 51);
            $pdf->Cell(51,5,$rowRAsesorDao[0],0,0,'C',1);
            
            // Protocolo etiqueta profesional        
            impresionColorClaro($grupoPEPValor,$rowRAsesorDao[1]);       
            $pdf->Cell(25,5,$rowRAsesorDao[1],0,0,'C',1); 

            // Servicio al cliente
            impresionColorClaro($grupoSCValor,$rowRAsesorDao[2]);       
            $pdf->Cell(24,5,$rowRAsesorDao[2],0,0,'C',1);
            
            // Negociacion
            impresionColorClaro($grupoNValor,$rowRAsesorDao[3]);       
            $pdf->Cell(24,5,$rowRAsesorDao[3],0,0,'C',1);
            
            // Actualizacion de datos
            impresionColorClaro($grupoADValor,$rowRAsesorDao[4]);       
            $pdf->Cell(24,5,$rowRAsesorDao[4],0,0,'C',1);

            // Registro en el sistema
            impresionColorClaro($grupoRSValor,$rowRAsesorDao[5]);       
            $pdf->Cell(24,5,$rowRAsesorDao[5],0,0,'C',1);

            $pdf->SetTextColor(28, 40, 51);
            // Calculo para acumulador total general
            impresionColorOscuro($rowRAsesorDao[6]);       
            $pdf->Cell(24,5,$rowRAsesorDao[6],0,1,'C',1);
            
            // Acumuladores
            $acumPromedioPEP += $rowRAsesorDao[1];
            $acumPromedioSC += $rowRAsesorDao[2];
            $acumPromedioN += $rowRAsesorDao[3];
            $acumPromedioAD += $rowRAsesorDao[4];
            $acumPromedioRS += $rowRAsesorDao[5];
            
            // Contadores
            $contNumeroAsesores ++;
            
            // Anulación de la consulta
            $rAsesorDao = null;

        }
    }

    // Cálculo de Seccion General
    $tGeneralPEP = $acumPromedioPEP / $contNumeroAsesores;
    $tGeneralSC = $acumPromedioSC / $contNumeroAsesores ;
    $tGeneralN = $acumPromedioN / $contNumeroAsesores ;
    $tGeneralAD = $acumPromedioAD / $contNumeroAsesores ;
    $tGeneralRS = $acumPromedioRS / $contNumeroAsesores ;
    $tGeneral = $tGeneralPEP+$tGeneralSC+$tGeneralN+$tGeneralAD+$tGeneralRS;

    // Total General
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(51,8,'Total general',0,0,'C',1); 
    $pdf->Cell(25,8,round($tGeneralPEP,1),0,0,'C',1); 
    $pdf->Cell(24,8,round($tGeneralSC,1),0,0,'C',1);
    $pdf->Cell(24,8,round($tGeneralN,1),0,0,'C',1);
    $pdf->Cell(24,8,round($tGeneralAD,1),0,0,'C',1);
    $pdf->Cell(24,8,round($tGeneralRS,1),0,0,'C',1);
    $pdf->Cell(24,8,round($tGeneral,1),0,1,'C',1);

    // Separador
    $pdf->AddPage();
    

    /* ************************************************ */
    /* ******************* UNIDADES ******************* */
    /* ************************************************ */


    // Titulo encabezado Ranking unidades
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(84,153,199);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE UNIDADES',1,1,'C',1);

    // Subtitulos respectivos
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(51,6,'UNIDADES',0,0,'C',1); 
    $pdf->Cell(25,6,'PEP',0,0,'C',1); 
    $pdf->Cell(24,6,'SC',0,0,'C',1);
    $pdf->Cell(24,6,'NEG',0,0,'C',1);
    $pdf->Cell(24,6,'AD',0,0,'C',1);
    $pdf->Cell(24,6,'RS',0,0,'C',1);
    $pdf->Cell(24,6,'GENERAL',0,1,'C',1);
    $pdf->SetTextColor(28, 40, 51);


    // Instancia a unidad
    $oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidadNEG($pdf->mes);

    foreach($resulORankUnidad as $rowResulORankUnidad){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(51,5,$rowResulORankUnidad[0],0,0,'C',1); 
            
            // PEP
            impresionColorClaro($grupoPEPValor,$rowResulORankUnidad[1]);
            $pdf->Cell(25,5,$rowResulORankUnidad[1],0,0,'C',1); 
            
            // SC
            impresionColorClaro($grupoSCValor,$rowResulORankUnidad[2]);
            $pdf->Cell(24,5,$rowResulORankUnidad[2],0,0,'C',1);
        
            // N
            impresionColorClaro($grupoNValor,$rowResulORankUnidad[3]);
            $pdf->Cell(24,5,$rowResulORankUnidad[3],0,0,'C',1);        
        
            // AD
            impresionColorClaro($grupoADValor,$rowResulORankUnidad[4]);
            $pdf->Cell(24,5,$rowResulORankUnidad[4],0,0,'C',1);
        
            // RS
            impresionColorClaro($grupoRSValor,$rowResulORankUnidad[5]);
            $pdf->Cell(24,5,$rowResulORankUnidad[5],0,0,'C',1);
        
            // TOTAL
            $pdf->SetTextColor(28, 40, 51);
            impresionColorOscuro($rowResulORankUnidad[6]);
            $pdf->Cell(24,5,$rowResulORankUnidad[6],0,1,'C',1);
        
            $acumPEPUnidades += $rowResulORankUnidad[1];
            $acumSCUnidades += $rowResulORankUnidad[2];
            $acumNUnidades += $rowResulORankUnidad[3];
            $acumADUnidades += $rowResulORankUnidad[4];
            $acumRSUnidades += $rowResulORankUnidad[5];
            $cTotalUnidades++;
    } 

    $pUnidadesPEP = $acumPEPUnidades / $cTotalUnidades;
    $pUnidadesSC = $acumSCUnidades / $cTotalUnidades;
    $pUnidadesN = $acumNUnidades / $cTotalUnidades;
    $pUnidadesAD = $acumADUnidades / $cTotalUnidades;
    $pUnidadesRS = $acumRSUnidades / $cTotalUnidades;
    $tGeneralUnidades = $pUnidadesPEP+$pUnidadesSC+$pUnidadesN+$pUnidadesAD+$pUnidadesRS;

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(51,7,'Promedio actual',0,0,'C',1); 
    $pdf->Cell(25,7,round($pUnidadesPEP, 1),0,0,'C',1); 
    $pdf->Cell(24,7,round($pUnidadesSC, 1),0,0,'C',1);
    $pdf->Cell(24,7,round($pUnidadesN, 1),0,0,'C',1);
    $pdf->Cell(24,7,round($pUnidadesAD, 1),0,0,'C',1);
    $pdf->Cell(24,7,round($pUnidadesRS, 1),0,0,'C',1);
    $pdf->Cell(24,7,round($tGeneralUnidades, 1),0,1,'C',1);

    $pdf->SetFillColor(82, 103, 123);
    $pdf->Cell(51,7,'Adherencia',0,0,'C',1); 
    $pdf->Cell(25,7, round($pUnidadesPEP * 100 / $grupoPEPValor, 1) . '%',0,0,'C',1); 
    $pdf->Cell(24,7, round($pUnidadesSC * 100 / $grupoSCValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(24,7, round($pUnidadesN * 100 / $grupoNValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(24,7, round($pUnidadesAD * 100 / $grupoADValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(24,7, round($pUnidadesRS * 100 / $grupoRSValor, 1) . '%',0,0,'C',1);
    $pdf->Cell(24,7, '- -' ,0,1,'C',1);

    // Separador
    $pdf->AddPage();



    /* ************************************** */
    /* ************************************** */
    /* ************************************** */



    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(84,153,199);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE ASESORES',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->Cell(70,6,'ASESORES',0,0,'C',1); 
    $pdf->Cell(25,6,'GESTIÓN 1',0,0,'C',1); 
    $pdf->Cell(25,6,'GESTIÓN 2',0,0,'C',1);
    $pdf->Cell(25,6,'GESTIÓN 3',0,0,'C',1);
    $pdf->Cell(25,6,'GESTIÓN 4',0,0,'C',1);
    $pdf->Cell(26,6,'TOTAL',0,1,'C',1);

    // Instancia a Asesor
    $oRankAsesor = new asesorDao();
    $rRankingAsesor = $oRankAsesor->listarRankingAsesorNEG($pdf->mes);
        
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
                 
        $asesores[$x][5] = round($subtotal / $totalGestiones , 1);
        
    }
        
         
    uasort($asesores, 'sort_by_orden');
            
    // Recorrido para impresion
    foreach($asesores as $rowAsesores){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(70,5,$rowAsesores[0],0,0,'C',1); 
            
            if(isset($rowAsesores[1])){
                impresionColorRankingA($rowAsesores[1]);
                $pdf->Cell(25,5,$rowAsesores[1],0,0,'C',1); 
                
                $acumTotalRankingG1 += $rowAsesores[1];
                $contTotalRankingG1++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1); 
            }
        
            // Negociación    
            if(isset($rowAsesores[2])){
                impresionColorRankingA($rowAsesores[2]);
                $pdf->Cell(25,5,$rowAsesores[2],0,0,'C',1);
                
                $acumTotalRankingG2 += $rowAsesores[2];
                $contTotalRankingG2++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
            
        
            // Registro en el sistema
            if(isset($rowAsesores[3])){
                impresionColorRankingA($rowAsesores[3]);
                $pdf->Cell(25,5,$rowAsesores[3],0,0,'C',1);
                
                $acumTotalRankingG3 += $rowAsesores[3];
                $contTotalRankingG3++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
        
        
            // Registro en el sistema
            if(isset($rowAsesores[4])){
                impresionColorRankingA($rowAsesores[4]);
                $pdf->Cell(25,5,$rowAsesores[4],0,0,'C',1);
                
                $acumTotalRankingG4 += $rowAsesores[4];
                $contTotalRankingG4++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
        
        
            // Total
        $pdf->SetTextColor(28, 40, 51);
            if(isset($rowAsesores[5])){
                impresionColorOscuro($rowAsesores[5]);
                $pdf->Cell(26,5,$rowAsesores[5] . "%",0,1,'C',1);
                
                $acumTotalRankingG5 += $rowAsesores[5];
                $contTotalRankingG5++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(26,5,"",0,1,'C',1);
            }
    } 


    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Total General
    $pdf->Cell(70,7,'ACUMULADO TOTAL',0,0,'C',1); 
        
    if($contTotalRankingG1 == 0){
        $pdf->Cell(25,7,0,0,0,'C',1); 
    }else{
        $pdf->Cell(25,7,round($acumTotalRankingG1/ $contTotalRankingG1,1),0,0,'C',1); 
    }
        
    if($contTotalRankingG2 == 0){
        $pdf->Cell(25,7,0,0,0,'C',1); 
    }else{
        $pdf->Cell(25,7,round($acumTotalRankingG2 / $contTotalRankingG2,1),0,0,'C',1);
    }
        
    if($contTotalRankingG3 == 0){
        $pdf->Cell(25,7,0,0,0,'C',1); 
    }else{
        $pdf->Cell(25,7,round($acumTotalRankingG3 / $contTotalRankingG3,1),0,0,'C',1);
    }  
        
    if($contTotalRankingG4 == 0){
        $pdf->Cell(25,7,0,0,0,'C',1); 
    }else{
        $pdf->Cell(25,7,round($acumTotalRankingG4 / $contTotalRankingG4,1),0,0,'C',1);
    }         
        
    if($contTotalRankingG5 == 0){
        $pdf->Cell(26,7,0,0,1,'C',1); 
    }else{
        $pdf->Cell(26,7,round($acumTotalRankingG5 / $contTotalRankingG5,1),0,1,'C',1);
    }

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
    $pdf->SetFillColor(84,153,199);
    $pdf->SetDrawColor(84,153,199);
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
    $rErroresCI = $erroresCriticosIDao->listarErroresCriticosInfringidosNEG($pdf->mes);

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
    $pdf->SetFillColor(84,153,199);
    $pdf->SetDrawColor(84,153,199);
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

    $objetoErrorCriticoNEGDao = new errorCriticoDao();
    $rErroresNEG = $objetoErrorCriticoNEGDao->listarErroresCriticosNEG($pdf->mes);
    
    $acumErroresCriticos = 0;

    foreach($rErroresNEG as $rowRErroresNEG){
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,$rowRErroresNEG[0],'T',0,'C',0); 
        $pdf->SetFillColor(235, 237, 239);
        $pdf->MultiCell(0,5,$rowRErroresNEG[1],'T','J',1);
        $acumErroresCriticos += $rowRErroresNEG[0];
    }

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(30,8,$acumErroresCriticos,0,0,'C',1); 
    $pdf->Cell(0,8,'TOTAL DE ERRORES CRÍTICOS',0,0,'L',1); 
     
    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","informe-f-negociacion-$pdf->mes.pdf");
        
    }
    else{
        header("location: indexReporteNEG.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>



