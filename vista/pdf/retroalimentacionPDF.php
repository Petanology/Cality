<?php

    require_once("../../modelo/retroalimentacionDao.php");
    require_once("../../controlador/zonaHoraria.php");
    require_once ("../../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    $SHIR = null;
    $vResultado = new retroalimentacionDao();

    switch($_GET["tabla"]){
        case "dc":
            $sihayInforme = $vResultado->validacionRetroalimentacionDC($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "dp":
            $sihayInforme = $vResultado->validacionRetroalimentacionDP($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "ie":
            $sihayInforme = $vResultado->validacionRetroalimentacionIE($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "ib":
            $sihayInforme = $vResultado->validacionRetroalimentacionIB($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "neg":
            $sihayInforme = $vResultado->validacionRetroalimentacionNEG($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "men":
            $sihayInforme = $vResultado->validacionRetroalimentacionMEN($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;

        case "ibf":
            $sihayInforme = $vResultado->validacionRetroalimentacionIBF($_GET["ultimosDias"] , $_GET["minimo"] , $_GET["maximo"] , $_SESSION['idpersona']);
        break;
    }

    foreach($sihayInforme as $rowSihayInforme){
        $SHIR = $rowSihayInforme;
    }

    if(isset($SHIR)){
        
        require_once("generalPDF-Retroalimentacion.php");
        require_once("funcionesColorFondoDetallado.php");
        require_once("../../modelo/retroalimentacionDao.php");
        require_once("../../controlador/sesiones.php");
        
        $sss = new sesiones(); // instancia a clase de sesiones
        $sss->iniciar();

        $pdf = new PDFRETROALIMENTACION('P','mm','letter'); // Página vertical, tamaño carta, medición en Milímetros 
        // Varaibles generales
        $pdf->tabla = $_GET["tabla"]; 
        $pdf->codigo = $_GET["codigo"]; 
        $pdf->version = $_GET["version"]; 
        $pdf->ultimosDias = $_GET["ultimosDias"];    
        $pdf->minimo = $_GET["minimo"];    
        $pdf->maximo = $_GET["maximo"];    
        $pdf->fechaVersion = $_GET["fechaVersion"];    
        $pdf->corte = $_GET["corte"];    

        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        $oRetroDao = new retroalimentacionDao();
        
        switch($pdf->tabla){
            case "dc":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionDC($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
                
            case "dp":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionDP($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;

            case "ie":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionIE($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
         
            case "ib":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionIB($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
                
            case "neg":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionNEG($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
                
            case "men":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionMEN($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
                
            case "ibf":
                $resultadoORetroDao = $oRetroDao->listarRetroalimentacionIBF($pdf->ultimosDias,$pdf->minimo,$pdf->maximo,$_SESSION['idpersona']);
            break;
        }
        
        // $this->SetTextColor(45,50,38);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(20,20,20);
        $pdf->SetDrawColor(50,50,50);
        
        $mes = array();
        $mes[1] = "Enero";
        $mes[2] = "Febrero";
        $mes[3] = "Marzo";
        $mes[4] = "Abril";
        $mes[5] = "Mayo";
        $mes[6] = "Junio";
        $mes[7] = "Julio";
        $mes[8] = "Agosto";
        $mes[9] = "Septiembre";
        $mes[10] = "Octubre";
        $mes[11] = "Noviembre";
        $mes[12] = "Diciembre";
        $mesActual = $mes[date("n")];
        
        $pdf->SetFillColor(230,230,230);
        $pdf->SetDrawColor(150,150,150);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(90,6,"  ANALISTA:   " . $_SESSION['nombres'],1,0,'L',1); 
        $pdf->Cell(70,6,"  FECHA:   $mesActual " . date("d") . " del " . date("Y"),1,0,'L',1); 
        $pdf->Cell(36,6,"  CORTE:   $pdf->corte",1,0,'L',1); 
        $pdf->Ln(8);
        
        
        $pdf->SetFont('Arial','',8);
        $pdf->WriteHTML('<p align="justify">Para  <b>GF COBRANZAS JURIDICAS</b> la calidad en la gestión  y el compromiso de la mejora continua  es pilar fundamental en nuestra labor diaria; Parte de esa labor diaria  es realizar  las gestiones bajo los parámetros  indicados, parámetros que queremos retroalimentar para su mejora continua.</p>');

        $pdf->SetFont('Arial','B',8);
        $pdf->Ln(7);
        
        $pdf->Cell(19,4,"UNIDAD",1,0,'C',1);
        $pdf->Cell(23,4,"GESTOR",1,0,'C',1);
        $pdf->Cell(12,4,"NOTA",1,0,'C',1);
        $pdf->Cell(58,4,"OBSERVACIONES",1,0,'C',1);
        $pdf->Cell(43,4,"ACUERDO PACTADO",1,0,'C',1);
        $pdf->Cell(43,4,"FIRMAS (ASESOR - LÍDER)",1,0,'C',1);
        
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(4);
        
        foreach($resultadoORetroDao as $rowRORetroDao){

            $pdf->SetWidths(array(19,23,12,58,43,43));
            $pdf->SetAligns(array("C","C","C","J","C","C"));
            //srand(microtime()*1000000);
            $pdf->Row(array(
                "\n$rowRORetroDao[0]\n",
                "\n$rowRORetroDao[1] - $rowRORetroDao[2]\n",
                "\n$rowRORetroDao[3]\n",
                "\n>> Fortalezas:\n$rowRORetroDao[4]\n>> Oportunidades de mejora:\n$rowRORetroDao[5]\n",
                "",
                ""
            ));
        }
        
        $pdf->Ln(2);
        $pdf->SetFont('Arial','',8);
        $pdf->WriteHTML('<p align="justify"><b>PARÁGRAFO: </b> El reiterado  incumplimiento de los compromisos adquiridos en la presente acta conlleva a las sanciones correspondientes y se procederá a evaluar el caso por parte de Talento Humano.</p>');
 
        $pdf->SetFont('Arial','B',8);
        $pdf->Ln(18);
        $pdf->SetLeftMargin(40);
        $pdf->Cell(60,5,"ANALISTA CALIDAD","T",0,"C",0);
        $pdf->SetLeftMargin(120);
        $pdf->Cell(60,5,"COORDINADOR","T",0,"C",0);
        $pdf->SetLeftMargin(0);
        $pdf->Ln(20);

    // Cerrar PDF 
    $pdf->Close();
    $fechaActual = date("Y\-m\-d");
    switch($pdf->tabla){
        case "dc":
            $nomArchivo = "retroalimentacion-negociacion-comercial-$fechaActual.pdf";
        break;

        case "dp":
            $nomArchivo = "retroalimentacion-negociacion-prejuridica-$fechaActual.pdf";
        break;

        case "ie":
            $nomArchivo = "retroalimentacion-mensaje-vd-$fechaActual.pdf";
        break;

        case "ib":
            $nomArchivo = "retroalimentacion-inbound-vd-$fechaActual.pdf";
        break;

        case "neg":
            $nomArchivo = "retroalimentacion-negociacion-f-$fechaActual.pdf";
        break;

        case "men":
            $nomArchivo = "retroalimentacion-mensaje-f-$fechaActual.pdf";
        break;

        case "ibf":
            $nomArchivo = "retroalimentacion-inbound-f-$fechaActual.pdf";
        break;
    }
        
    $pdf->Output("I",$nomArchivo);
        
    }
    else{
        header("location: retroalimentacion.php?mensaje=No hay resultado para la busqueda que esta realizando...");
    }
?>