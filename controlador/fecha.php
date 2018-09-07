<?php

    class fecha{
        public function traerFecha(){
            
            $dia1 = date("w");
            $numero1 = date("d");
            $mes1 = date("n");
            $anno1 = date("Y");
            
            /* Días de la semana */
            $diasTotales = array(
                0=>"Domingo",
                1=>"Lunes",
                2=>"Martes",
                3=>"Miércoles",
                4=>"Jueves",
                5=>"Viernes",
                6 =>"Sábado"
            );
            
            /* Meses totales */
            $mesesTotales = array(
                1=>"Enero",
                2=>"Febrero",
                3=>"Marzo",
                4=>"Abril",
                5=>"Mayo",
                6=>"Junio",
                7=>"Julio",
                8=>"Agosto",
                9=>"Septiembre",
                10=>"Octubre",
                11=>"Noviembre",
                12=>"Diciembre"
            );
            
            $dia2 = $diasTotales[$dia1];
            $mes2 = $mesesTotales[$mes1];
            
            return "$dia2, $numero1 de $mes2 del $anno1";
        }
    }

?>