<?php

    /*  COLORES:
        ___________________________________________________
        |  - - - - -  |  Claros         |  Oscuros         |
        |  verde      |  130, 224, 170  |  88, 214, 141    |
        |  amarillo   |  249, 231, 159  |  247, 220, 111   |
        |  rojo       |  236, 112, 99   |  231, 76, 60     |
        ---------------------------------------------------    */

    require_once("../../modelo/asesorDao.php");
    require_once("../../modelo/errorCriticoDao.php");
    require_once("../../modelo/generarPDFDao.php");
    require_once("../../modelo/unidadDao.php");
    require_once("generalPDF-DC.php");

    // Varaibles generales
    $mes = $_POST["mesReporte"];

    $pdf = new PDF('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
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

    // Porcentajes titulos tabla
    $pdf->Cell(51,4,'- LÍDER -',0,0,'C',1); 
    
    $objetoPDFDao = new generarPDFDao();
    $rValorPDF = $objetoPDFDao->listarPrimerValorGrupoDC($mes);
    foreach($rValorPDF as $rowRV){
        $pdf->Cell(55,4,"$rowRV[0]%",0,0,'C',1); 
        $pdf->Cell(25,4,"$rowRV[1]%",0,0,'C',1);
        $pdf->Cell(41,4,"$rowRV[2]%",0,0,'C',1);
        $pdf->Cell(24,4,$rowRV[0]+$rowRV[1]+$rowRV[2] ."%",0,1,'C',1);
    }    
    
    $ojetoAsesorDao = new asesorDao();
    $rAsesorDao = $ojetoAsesorDao->listarPromedioGeneral("2018");
    
    $contadorLideres = 0;
    
    $imprimirLider = true;
    $liderReferencia = "";

    $acumTotalSET = 0;

    foreach($rAsesorDao as $rowRAsesorDao) {
        
        if($liderReferencia == $rowRAsesorDao[0]){
            $imprimirLider = false;
        }
        
        if($ == ){
            $pdf->Cell(24,6,$acumTotalSET,0,1,'C',1);
        }
            
        if($imprimirLider){    
            // Líderes de grupo
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFillColor(93, 109, 126);
            $pdf->Cell(51,6,$rowRAsesorDao[0],0,0,'C',1);
            $pdf->Cell(55,6,$acumTotalSET,0,0,'C',1); 
            $pdf->Cell(25,6,"0",0,0,'C',1);
            $pdf->Cell(41,6,"0",0,0,'C',1);
            $pdf->Cell(24,6,"0",0,1,'C',1);
        }

        // Nombre Asesor y Demás
        $pdf->SetFillColor(214, 219, 223);
        $pdf->SetTextColor(28, 40, 51);
        $pdf->Cell(51,5,$rowRAsesorDao[1],0,0,'C',1);
        
        // Acumulador total del servicio y etqueta telefónica
        $acumTotalSET += $rowRAsesorDao[1];

        // Servicio y Etiqueta Telefónica
        $pdf->SetFillColor(130, 224, 170);          
        $pdf->Cell(55,5,$rowRAsesorDao[2],0,0,'C',1); 

        $pdf->SetFillColor(249, 231, 159);
        $pdf->Cell(25,5,$rowRAsesorDao[3],0,0,'C',1);

        $pdf->SetFillColor(236, 112, 99);
        $pdf->Cell(41,5,$rowRAsesorDao[4],0,0,'C',1);

        $pdf->SetFillColor(231, 76, 60);
        $resultadoAsesor = $rowRAsesorDao[2]+$rowRAsesorDao[3]+$rowRAsesorDao[4];
        $pdf->Cell(24,5,$resultadoAsesor,0,1,'C',1);
        
        $liderReferencia = $rowRAsesorDao[0];  
    }


    /*
        // Asesores
        for($is = 0; $is<12; $is++){
            // Nombre
            $pdf->SetFillColor(214, 219, 223);
            $pdf->Cell(51,5,'Paola Andrea Ramirez Suaza',0,0,'C',1); 
            
            // Servicio y etiqueta telefónica
            $pdf->SetFillColor(130, 224, 170);
            $pdf->Cell(55,5,'27',0,0,'C',1); 
            
            $pdf->SetFillColor(249, 231, 159);
            $pdf->Cell(25,5,'46',0,0,'C',1);
            
            $pdf->SetFillColor(236, 112, 99);
            $pdf->Cell(41,5,'20',0,0,'C',1);
            
            $pdf->SetFillColor(231, 76, 60);
            $pdf->Cell(24,5,'93',0,1,'C',1);
            
        }
                
    }*/

    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(51,8,'Total general',0,0,'C',1); 
    $pdf->Cell(55,8,'27',0,0,'C',1); 
    $pdf->Cell(25,8,'41',0,0,'C',1);
    $pdf->Cell(41,8,'18',0,0,'C',1);
    $pdf->Cell(24,8,'86',0,1,'C',1);

    // Separador
    $pdf->AddPage();
    




    /* ************************************** */
    /* ************************************** */
    /* ************************************** */




    // Color de Encabezado de Tabla
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(46, 134, 193);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(0,8,'RANKING DE UNIDADES',1,1,'C',1);

    // Color de fondo y borde oscuro 
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetFont('Arial','B',8);

    // Titulos tabla
    $pdf->Cell(51,6,'UNIDADES',0,0,'C',1); 
    $pdf->Cell(55,6,'SERVICIO Y ETIQUETA TELEFÓNICA',0,0,'C',1); 
    $pdf->Cell(25,6,'NEGOCIACIÓN',0,0,'C',1);
    $pdf->Cell(41,6,'REGISTRO EN EL SISTEMA',0,0,'C',1);
    $pdf->Cell(24,6,'GENERAL',0,1,'C',1);

    // UNIDADES
    $pdf->SetTextColor(28, 40, 51);
    
    $oRankUnidad = new unidadDao();
    $resulORankUnidad = $oRankUnidad->listarRankingUnidad("2018%");
    
    // PROMEDIO - SERVICIO Y ETIQUETA TELEFONICA 
    $acumSETUnidades = 0;
    $contSETUnidades = 0;

    // PROMEDIO - NEGOCIACION
    $acumNEGUnidades = 0;
    $contNEGUnidades = 0;

    // PROMEDIO - REGISTRO EN EL SISTEMA
    $acumRSUnidades = 0;
    $contRSUnidades = 0;

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
            $contSETUnidades++;
        
            $acumNEGUnidades += $rowResulORankUnidad[2];
            $contNEGUnidades++;
                
            $acumRSUnidades += $rowResulORankUnidad[3];
            $contRSUnidades++;
        
    } 

    $promedioSET = $acumSETUnidades / $contSETUnidades;
    $promedioNEG = $acumNEGUnidades / $contNEGUnidades;
    $promedioRS = $acumRSUnidades / $contRSUnidades;
    $totalGeneralDC = $promedioSET+$promedioNEG+$promedioRS;

    // Colores
    $pdf->SetFillColor(52, 73, 94);
    $pdf->SetTextColor(255, 255, 255);

    // Promedio
    $pdf->Cell(51,5,'Promedio actual',0,0,'C',1); 
    $pdf->Cell(55,5,round($promedioSET),0,0,'C',1); 
    $pdf->Cell(25,5,round($promedioNEG),0,0,'C',1);
    $pdf->Cell(41,5,round($promedioRS),0,0,'C',1);
    $pdf->Cell(24,5,round($totalGeneralDC),0,1,'C',1);


    // Adherencia
    $pdf->Cell(51,5,'Adherencia',0,0,'C',1); 
    $pdf->Cell(55,5, round($promedioSET * 100 / 30) . '%',0,0,'C',1); 
    $pdf->Cell(25,5, round($promedioNEG * 100 / 50) . '%',0,0,'C',1);
    $pdf->Cell(41,5, round($promedioRS * 100 / 20) . '%',0,0,'C',1);
    $pdf->Cell(24,5, '- -' ,0,1,'C',1);

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
    $pdf->Cell(25,6,'SEMANA 1',0,0,'C',1); 
    $pdf->Cell(25,6,'SEMANA 2',0,0,'C',1);
    $pdf->Cell(25,6,'SEMANA 3',0,0,'C',1);
    $pdf->Cell(30,6,'TOTAL GENERAL',0,1,'C',1);

    // Unidades
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
    $rErroresCI = $erroresCriticosIDao->listarErroresCriticosInfringidos($mes);

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
    $rErroresDC = $objetoErrorCriticoDCDao->listarErroresCriticosDC($mes);
    
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



















    $pdf->Close();
    $pdf->Output("I","informe-venta-directa_agosto-2018.pdf");
    
    /*
    $ejemploDao = new ejemploDao();
    $listar = $ejemploDao->ejemplo();

    $filaTabla = 1;
    foreach($listar as $rowEJE){
        
        if($filaTabla % 2 == 0){
            $pdf->SetFillColor(220,220,220);
        }else {
            $pdf->SetFillColor(255,255,255);
        }
        $pdf->Cell(20,6,$rowEJE[0],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[1],1,0,'C',1);
        $pdf->Cell(70,6,$rowEJE[2],1,1,'C',1);
            
            
        $filaTabla++;
    }*/

    /*
        $pdf->Cell(70,6,"ejemplo",0,0,'C',1);
        $pdf->Cell(70,6,"ejemplo",0,1,'C',1);

    foreach($resultado as $row){
        
        $pdf->Cell(20,6,$row[0],1,0,'C',1);
        $pdf->Cell(70,6,$row[1],1,0,'C',1);
        $pdf->Cell(70,6,$row[2],1,1,'C',1);
        
    }

    */
?>



































