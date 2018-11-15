<?php
    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDF extends FPDF {
        
        function Header(){
            
            $this->SetFillColor(46,134,193);
            $this->SetXY(0,0);
            $this->Cell(210,25,'',0,1,'C',1);
            
            $this->Image('../img/gf-logo.png',10,5,15);
            
            $this->SetFillColor(255,255,255);
            $this->Cell(1,20,'',0,1,'C',1);
            $this->SetXY(20,);
            
            //$this->SetFillColor(255,255,255);
            $this->Ln(20);
            
            $this->SetFont('Arial','',10);
            $this->Cell(30);
            $this->Cell(120, 10, 'Reporte de Estados', 0 , 0 , '' , 1);
            
            $this->Ln(20);
        }
        
        
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(0 , 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0 , 0 , 'C' );
        }
    }
?>