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
/*
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
*/
        
    // Calcular Totales Claros
/*    function impresionColorRankingA($nResultado){
        global $pdf;
        if($nResultado >= 0 && $nResultado <= 68){
            $pdf->SetFillColor(236, 112, 99);
        } else if($nResultado >= 69 && $nResultado <= 84){
            $pdf->SetFillColor(249, 231, 159);
        } else if($nResultado >= 85 && $nResultado <= 100){
            $pdf->SetFillColor(130, 224, 170);
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }
    }
*/        
    // Calcular y aplciar color de fondo para grupo de items
/*    function impresionColorClaro($maximo,$nResultado){
        global $pdf;
        
        $indicadorMaximo = $maximo;
        $indicadorRojo = 69 * $indicadorMaximo / 100;
        $indicadorAmarillo = 85 * $indicadorMaximo / 100;
        
        if($nResultado >= 0 && $nResultado < $indicadorRojo){
            
            $pdf->SetFillColor(236, 112, 99);
            
        } else if($nResultado >= $indicadorRojo && $nResultado < $indicadorAmarillo){
            
            $pdf->SetFillColor(249, 231, 159);
            
        } else if($nResultado >= $indicadorAmarillo && $nResultado <= $indicadorMaximo){
            
            $pdf->SetFillColor(130, 224, 170);
            
        } else {
            $pdf->SetFillColor(142, 68, 173);
        }

    }
  */  
?>