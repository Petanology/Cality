<?php
    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDF extends FPDF {
        
        function Header(){
            $this->SetFillColor(52,152,219);
            $this->Image('C:\Users\SoporteTecnico3\Pictures\Institucionales/GF-COBRANZAS-JURIDICAS-nuevo.jpg',5,5,30);
            $this->SetFont('Arial','',10);
            $this->Cell(30);
            $this->Cell(120, 10, 'Reporte de Estados', 0 , 0 , '' , 1);
            
            $this->Ln(20);
        }
        
        
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0 , 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0 , 0 , 'C' );
        }
    }
?>