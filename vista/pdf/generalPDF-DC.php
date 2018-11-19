<?php

    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDF extends FPDF {
        
        function Header(){
            // Fondo Azul
            $this->SetFillColor(46,134,193);
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
            $this->SetFillColor(52, 152, 219);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial','B',13);
            $this->SetXY(50,7);;
            $this->Cell(0,13,'INFORME VENTA DIRECTA AGOSTO 2018','LR',0,'C',1);
            
            // Salto de Línea para tabla
            $this->Ln(25);
        }
        
        
        function Footer(){
            // 
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0 , 10, 'Página ' . $this->PageNo() . ' de {nb}', 0 , 0 , 'C' );
        }
    }
?>