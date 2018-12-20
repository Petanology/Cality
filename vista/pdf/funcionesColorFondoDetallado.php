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
            
            $pdf->SetTextColor(231, 76, 60); // rojo
            
        } else if($nResultado > 0 && $nResultado <= 0.5){
            
            $pdf->SetTextColor(211, 84, 0); // naranja
            
        } else if($nResultado > 0.6 && $nResultado <= 0.9){
            
            $pdf->SetTextColor(202, 111, 30); // amarillo
            
        } else if($nResultado == 1){
            $pdf->SetTextColor(17, 122, 101); // verde
        }
    }  
?>