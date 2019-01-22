<?php
    require_once("../../modelo/gestionGeneralDao.php");
    
    $SHIR = null;
    
    $vResultados = new gestionGeneralDao();

    $sihayInforme = $vResultados->validacionParaInformeDC($_GET["mesReporte"]);
    

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }
    
    if(isset($SHIR)){

    require_once("../../modelo/liderDao.php");
    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalRankingAsesoresF.php");
    require_once("../../controlador/arrayColumns.php");

    // Declaración de acumuladores
    $acumPromedioSET = 0;
    $acumPromedioNEG = 0;
    $acumPromedioCC = 0;
    $acumPromedioRS = 0;
        
    $acumSETUnidades = 0;
    $acumNEGUnidades = 0;
    $acumCCUnidades = 0;
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
    $grupoCCValor = 0;
    $grupoRSValor = 0;

    $pdf = new PDFDC('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
    
    // Varaibles generales
    $pdf->mes = $_GET["mesReporte"];
    $pdf->AliasNbPages();
    $pdf->AddPage();
        
    require_once("funcionesColorFondo.php");

    /* ************************************** */
    /* ************************************** */
    /* ************************************** */



    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(0,139,186);
    $pdf->SetDrawColor(0,139,186);
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

    // se crea array para guardar todas las gestiones
    $asesores = array();
        
    // Instancia a Asesor
    $oRankAsesor = new asesorDao();
        
        
        
    // Asignacion para NEG
    $rRankingAsesor = $oRankAsesor->listarRankingAsesorNEG($pdf->mes);
    foreach($rRankingAsesor as $ConsultaRA){
        $resultado = array_search($ConsultaRA[0] , array_column($asesores , 0));
        if(is_numeric($resultado)) {
            $asesores[$resultado][] =  $ConsultaRA[1];
        } else {
            $asesores[] = array(0 => $ConsultaRA[0] , 1 => $ConsultaRA[1]);
        }
    }
    $rRankingAsesor = null;
        
    
        
    // Asignacion para MEN
    $rRankingAsesor = $oRankAsesor->listarRankingAsesorMEN($pdf->mes);
    foreach($rRankingAsesor as $ConsultaRA){
        $resultado = array_search($ConsultaRA[0] , array_column($asesores , 0));
        if(is_numeric($resultado)) {
            $asesores[$resultado][] =  $ConsultaRA[1];
        } else {
            $asesores[] = array(0 => $ConsultaRA[0] , 1 => $ConsultaRA[1]);
        }
    }
    $rRankingAsesor = null;
        
        
        
    // Asignacion para IBF
    $rRankingAsesor = $oRankAsesor->listarRankingAsesorIBF($pdf->mes);
    foreach($rRankingAsesor as $ConsultaRA){
        $resultado = array_search($ConsultaRA[0] , array_column($asesores , 0));
        if(is_numeric($resultado)) {
            $asesores[$resultado][] =  $ConsultaRA[1];
        } else {
            $asesores[] = array(0 => $ConsultaRA[0] , 1 => $ConsultaRA[1]);
        }
    }
    $rRankingAsesor = null;

        
    // Recorrido para asignar total por asesor    
    for($x=0; $x<count($asesores); $x++){
        
        $subtotal = 0;
        $totalGestiones = count($asesores[$x]) - 1;
        
        for($i=1; $i<count($asesores[$x]); $i++){
            
            $subtotal += $asesores[$x][$i];   
            
        }
        
        $porcAcum = round($subtotal / $totalGestiones, 1);        
        $asesores[$x][5] = $porcAcum;
        
    }
        
    $aux = array();
    
    foreach($asesores as $key => $rowFAsesor){
        $aux[$key] = $rowFAsesor[5];
    }
        
    array_multisort($aux, SORT_DESC, $asesores);
    
            
    $pdf->SetTextColor(28, 40, 51);
    // Recorrido para impresion
    foreach($asesores as $rowAsesores){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(70,5,$rowAsesores[0],0,0,'C',1); 
            
            // GESTION 1
            if(isset($rowAsesores[1])){
                impresionColorRankingA($rowAsesores[1]);
                $pdf->Cell(25,5,$rowAsesores[1],0,0,'C',1); 
                
                $acumTotalRankingG1 += $rowAsesores[1];
                $contTotalRankingG1++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1); 
            }
        
            // GESTIÓN 2    
            if(isset($rowAsesores[2])){
                impresionColorRankingA($rowAsesores[2]);
                $pdf->Cell(25,5,$rowAsesores[2],0,0,'C',1);
                
                $acumTotalRankingG2 += $rowAsesores[2];
                $contTotalRankingG2++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
        
            // GESTION 3    
            if(isset($rowAsesores[3])){
                impresionColorRankingA($rowAsesores[3]);
                $pdf->Cell(25,5,$rowAsesores[3],0,0,'C',1);
                
                $acumTotalRankingG3 += $rowAsesores[3];
                $contTotalRankingG3++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
            
        
            // GESTION 4
            if(isset($rowAsesores[4])){
                impresionColorRankingA($rowAsesores[4]);
                $pdf->Cell(25,5,$rowAsesores[4],0,0,'C',1);
                
                $acumTotalRankingG4 += $rowAsesores[4];
                $contTotalRankingG4++;
            }else{
                $pdf->SetFillColor(93, 109, 126);
                $pdf->Cell(25,5,"",0,0,'C',1);
            }
        
            // TOTAL
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
     
    // Cerrar PDF 
    $pdf->Close();
    $pdf->Output("I","ranking-asesores-f-$pdf->mes.pdf");
        
    }
    else{
        header("location: indexReporteDC.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>



































