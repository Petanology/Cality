<?php

    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDFMEN_D extends FPDF {
        
        public $mesReporte;
        public $asesorConsulta;
        
        function Header(){
            // Fondo Azul
            $this->SetFillColor(88, 140, 173);
            $this->SetXY(0,0);
            $this->Cell($this->GetPageWidth(),24,'',0,0,'C',1);
            
            // Logo GF
            $this->Image('../img/gf-logo.png',10,5,15);
            
            // Linea blanca
            $this->SetDrawColor(230,230,230);
            $this->line(28,10,28,17);
            
            // Logo Cality
            $this->Image('../img/faviconx512-4.png',31,7,12);
            
            // Titulo principal
            $this->SetFillColor(110, 160, 194);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial','B',13);
            $this->SetXY(50,7);;
            $this->Cell(0,13,"DETALLADO MENSAJE F " . $this->ImprimirMes($this->mesReporte),'LR',0,'C',1);
            
            // Salto de Línea para tabla
            $this->Ln(25);
        }
        
        
        function Footer(){
             
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0 , 10, 'Página ' . $this->PageNo() . ' de {nb}', 0 , 0 , 'C' );
        }
        
        
        function ImprimirMes($mesACambiar){
            $fecha = explode("-" , $mesACambiar);
            $ano = $fecha[0]; // obtener el año, ejemplo : 2018
            $mes = ltrim($fecha[1] , '0'); // obtener el mes, ejemplo : 11
            
            $nomMes = array();
            $nomMes[1] = "ENERO";
            $nomMes[2] = "FEBRERO";
            $nomMes[3] = "MARZO";
            $nomMes[4] = "ABRIL";
            $nomMes[5] = "MAYO";
            $nomMes[6] = "JUNIO";
            $nomMes[7] = "JULIO";
            $nomMes[8] = "AGOSTO";
            $nomMes[9] = "SEPTIEMBRE";
            $nomMes[10] = "OCTUBRE";
            $nomMes[11] = "NOVIEMBRE";
            $nomMes[12] = "DICIEMBRE";
            
            return "$nomMes[$mes] DEL $ano";
        }
    }


?>