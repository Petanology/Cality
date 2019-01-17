<?php
    require_once ("../modelo/encabezadoDao.php");
    require_once ("../modelo/gestionGeneralDao.php");
    require_once ("../controlador/sesiones.php");

    $sss = new sesiones();
    $sss->iniciar();

    class gestionNEGControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            // instancia al Dao
            $encabezadoDao = new encabezadoDao();
            $gestionGeneralDao = new gestionGeneralDao();
                    
            // Variables
            $fecha = $_POST["fecha"];
            $idGestion = $_POST["identificacion"] . "-" . $fecha; // id
            $tipoMonitoreo = $_POST["tipo-monitoreo"];
            $errorCritico = $_POST["error-critico"];
            $unidad = $_POST["unidad"];
            $asesor = $_POST["identificacion"];
            $analista = $_SESSION["idpersona"];
            
            // observacion
            $llamada = $_POST["llamada"];
            $fortalezas = $_POST["fortalezas"];
            $oportunidades = $_POST["oportunidades"];
            
            $totalItemsNPEP = $_POST["totalItemsNPEP"];
            $totalItemsNSC = $_POST["totalItemsNSC"];
            $totalItemsNN = $_POST["totalItemsNN"];
            $totalItemsNAD = $_POST["totalItemsNAD"];
            $totalItemsNRS = $_POST["totalItemsNRS"];
            
            $primerCampo = "npep";
            $segundoCampo= "nsc";
            $tercerCampo = "nn";
            $cuartoCampo = "na";
            $quintoCampo = "nr";
            
            $primeraTabla = "neg_pep";
            $segundaTabla = "neg_sc";
            $terceraTabla = "neg_n";
            $cuartaTabla = "neg_ad";
            $quintaTabla = "neg_rs";
            
            // Totales de cada grupo
            $acum_npep_input = $_POST["acum_npep_input"];
            $acum_nsc_input = $_POST["acum_nsc_input"];
            $acum_nn_input = $_POST["acum_nn_input"];
            $acum_nad_input = $_POST["acum_nad_input"];
            $acum_nrs_input = $_POST["acum_nrs_input"];
            
            $valor[1] = $_POST["valorSeccionTabla1"];
            $valor[2] = $_POST["valorSeccionTabla2"];
            $valor[3] = $_POST["valorSeccionTabla3"];
            $valor[4] = $_POST["valorSeccionTabla4"];
            $valor[5] = $_POST["valorSeccionTabla5"];

            /* ************************** */
            
            $seccion1 = array();
            $i = 1; // numero items
            $f = 1; // repeticiones bucle
            
            while($f <= $totalItemsNPEP){
                if(isset($_POST["npep_".$i])){
                    $seccion1[$i][0] = $_POST["npep_".$i];
                    $seccion1[$i][1] = $i;
                    $f++;
                }else{
                }
                $i++;
            }
            
            /* ************************** */
            
            $seccion2 = array();
            $i2 = 1; // numero items
            $f2 = 1; // repeticiones bucle
            
            while($f2 <= $totalItemsNSC){
                if(isset($_POST["nsc_".$i2])){
                    $seccion2[$i2][0] = $_POST["nsc_".$i2];
                    $seccion2[$i2][1] = $i2;
                    $f2++;
                }else{
                }
                $i2++;
            }
                  
            /* ************************** */
            
            $seccion3 = array();
            $i3 = 1; // numero items
            $f3 = 1; // repeticiones bucle
            
            while($f3 <= $totalItemsNN){
                if(isset($_POST["nn_".$i3])){
                    $seccion3[$i3][0] = $_POST["nn_".$i3];
                    $seccion3[$i3][1] = $i3;
                    $f3++;
                }else{
                }
                $i3++;
            }
            
            /* ************************** */
            
            $seccion4 = array();
            $i4 = 1; // numero items
            $f4 = 1; // repeticiones bucle
            
            while($f4 <= $totalItemsNAD){
                if(isset($_POST["nad_".$i4])){
                    $seccion4[$i4][0] = $_POST["nad_".$i4];
                    $seccion4[$i4][1] = $i4;
                    $f4++;
                }else{
                }
                $i4++;
            }
            
            
            /* ************************** */
            
            $seccion5 = array();
            $i5 = 1; // numero items
            $f5 = 1; // repeticiones bucle
            
            while($f5 <= $totalItemsNRS){
                if(isset($_POST["nrs_".$i5])){
                    $seccion5[$i5][0] = $_POST["nrs_".$i5];
                    $seccion5[$i5][1] = $i5;
                    $f5++;
                }else{
                }
                $i5++;
            }
            
            /* ************************** */
            
            $mRPositivo = "¡Felicidades, el registro <strong> '" . $idGestion . "' </strong> fue todo un éxito!";
            
            if($encabezadoDao->registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$llamada,$fortalezas,$oportunidades)) {
                
                for($i = 1; $i < 6; $i++){
                    $encabezadoDao->registrarValorSeccionEncabezado($idGestion,$i,$valor[$i]);                    
                }
    
                // Registrar promedio alcanzado por seccion
                if($errorCritico == 1){
                    $encabezadoDao->registrarPromedio_neg($idGestion,$acum_npep_input,$acum_nsc_input,$acum_nn_input,$acum_nad_input,$acum_nrs_input);
                } else {
                    $encabezadoDao->registrarPromedio_neg($idGestion, 0 , 0 , 0 , 0 , 0);
                }

                foreach($seccion1 as $aprobadoItem){
                    $gestionGeneralDao->registrarCalificacion($primeraTabla,$primerCampo,$idGestion,$aprobadoItem[1],$aprobadoItem[0]);
                }
                
                foreach($seccion2 as $aprobadoItem2){
                    $gestionGeneralDao->registrarCalificacion($segundaTabla,$segundoCampo,$idGestion,$aprobadoItem2[1],$aprobadoItem2[0]);
                }
                
                foreach($seccion3 as $aprobadoItem3){
                    $gestionGeneralDao->registrarCalificacion($terceraTabla,$tercerCampo,$idGestion,$aprobadoItem3[1],$aprobadoItem3[0]);
                }
                
                
                foreach($seccion4 as $aprobadoItem4){
                    $gestionGeneralDao->registrarCalificacion($cuartaTabla,$cuartoCampo,$idGestion,$aprobadoItem4[1],$aprobadoItem4[0]);
                }
                

                foreach($seccion5 as $aprobadoItem5){
                    $gestionGeneralDao->registrarCalificacion($quintaTabla,$quintoCampo,$idGestion,$aprobadoItem5[1],$aprobadoItem5[0]);
                }
                
                $this->redireccion($mRPositivo);
                
            }else{
                $this->redireccion($mNegativo);
                
            }
        }
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/gestionNEG.php?m=$pMensaje");
        }
    }

    $gestionNEGC = new gestionNEGControlador(); 
?>