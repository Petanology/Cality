<?php 

    function textoDeFecha($fecha){
        
        $mesString = array(
            1 => "Enero",
            2 => "Febrero",
            3 => "Marzo",
            4 => "Abril",
            5 => "Mayo",
            6 => "Junio",
            7 => "Julio",
            8 => "Agosto",
            9 => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre",
        );
        
        $secc_fecha = explode("-" , $fecha);
        
        $ano = $secc_fecha[0];
        $intmes = ltrim((int)$secc_fecha[1]);
        $mes = $mesString[$intmes];
        $dia = $secc_fecha[2];
        
        
        return "$mes, $dia del $ano";
    } 
        
?>