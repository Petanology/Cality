<?php

    /*  COLORES:
        ___________________________________________________
        |  - - - - -  |  Claros         |  Oscuros         |
        |  verde      |  130, 224, 170  |  88, 214, 141    |
        |  amarillo   |  249, 231, 159  |  247, 220, 111   |
        |  rojo       |  236, 112, 99   |  231, 76, 60     |
        ---------------------------------------------------    
    */

    // Calcular Promedio C-Directo
    function impresionColorOscuro($nResultado){
        global $pdf;
        if($nResultado >= 0 && $nResultado <= 68){
            $pdf->SetFillColor(231, 76, 60);
        } else if($nResultado >= 69 && $nResultado <= 84){
            $pdf->SetFillColor(247, 220, 111);
        } else if($nResultado >= 85 && $nResultado <= 100){
            $pdf->SetFillColor(88, 214, 141);
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }
    }

        
    // Calcular Totales Claros
    function impresionColorRankingA($nResultado){
        global $pdf;
        if($nResultado >= 0 && $nResultado <= 68){
            $pdf->SetTextColor(231, 76, 60);
        } else if($nResultado >= 69 && $nResultado <= 84){
            $pdf->SetTextColor(202, 111, 30);
        } else if($nResultado >= 85 && $nResultado <= 100){
            $pdf->SetTextColor(17, 122, 101);
        } else {
            $pdf->SetTextColor(142, 68, 173);
        }
    }
        
    // Calcular y aplciar color de fondo para grupo de items
    function impresionColorClaro($maximo,$nResultado){
        global $pdf;
        
        $indicadorMaximo = $maximo;
        $indicadorRojo = 69 * $indicadorMaximo / 100;
        $indicadorAmarillo = 85 * $indicadorMaximo / 100;
        
        if($nResultado >= 0 && $nResultado < $indicadorRojo){
            // Rojo
            $pdf->SetTextColor(231, 76, 60);
            
        } else if($nResultado >= $indicadorRojo && $nResultado < $indicadorAmarillo){
            // Amarillo
            $pdf->SetTextColor(202, 111, 30);
            
        } else if($nResultado >= $indicadorAmarillo && $nResultado <= $indicadorMaximo){
            // Verde
            $pdf->SetTextColor(17, 122, 101);
            
        } else {
            $pdf->SetTextColor(142, 68, 173);
        }

    }
    
?>