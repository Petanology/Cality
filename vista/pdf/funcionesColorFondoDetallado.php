<?php

    /*  COLORES:
        ________________________________
        |  verde      |  130, 224, 170 |
        |  amarillo   |  249, 231, 159 |
        |  naranja    |  235, 152, 78  |
        |  rojo       |  236, 112, 99  |
        --------------------------------    
    */

    // Calcular Promedio C-Directo

    function impresionAprobado($nResultado){
        
        global $pdf;
        
        if($nResultado == 0){
            
            $pdf->SetFillColor(236, 112, 99); // rojo
            
        } else if($nResultado > 0 && $nResultado <= 0.5){
            
            $pdf->SetFillColor(235, 152, 78); // naranja
            
        } else if($nResultado > 0.6 && $nResultado <= 0.9){
            
            $pdf->SetFillColor(249, 231, 159); // amarillo
            
        } else if($nResultado == 1){
            $pdf->SetFillColor(130, 224, 170); // verde
        }
    }  
?>