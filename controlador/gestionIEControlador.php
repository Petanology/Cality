<?php
    require_once ("../modelo/encabezadoDao.php");
    require_once ("../modelo/gestionGeneralDao.php");
    require_once ("../controlador/sesiones.php");

    $sss = new sesiones();
    $sss->iniciar();

    class gestionIEControlador{

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
            
            $totalItemsIES = $_POST["totalItemsIES"];
            $totalItemsIEI = $_POST["totalItemsIEI"]; 
            $totalItemsIER = $_POST["totalItemsIER"];
            $primerCampo = "ies";
            $segundoCampo = "iei";
            $tercerCampo = "ier";
            $primeraTabla = "indi_est_set";
            $segundaTabla = "indi_est_it";
            $terceraTabla = "indi_est_rs";
            
            // Totales de cada grupo
            $acum_ies_input = $_POST["acum_ies_input"];
            $acum_iei_input = $_POST["acum_iei_input"];
            $acum_ier_input = $_POST["acum_ier_input"];
            
            $valor[1] = $_POST["valorSeccionTabla1"];
            $valor[2] = $_POST["valorSeccionTabla2"];
            $valor[3] = $_POST["valorSeccionTabla3"];

            /* ************************** */
            
            $seccion1 = array();
            $i = 1; // numero items
            $f = 1; // repeticiones bucle
            
            while($f <= $totalItemsIES){
                if(isset($_POST["ies_".$i])){
                    $seccion1[$i][0] = $_POST["ies_".$i];
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
            
            while($f2 <= $totalItemsIEI){
                if(isset($_POST["iei_".$i2])){
                    $seccion2[$i2][0] = $_POST["iei_".$i2];
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
            
            while($f3 <= $totalItemsIER){
                if(isset($_POST["ier_".$i3])){
                    $seccion3[$i3][0] = $_POST["ier_".$i3];
                    $seccion3[$i3][1] = $i3;
                    $f3++;
                }else{
                }
                $i3++;
            }
            
            /* ************************** */
            
            $mRPositivo = "¡Felicidades, el registro <strong> '" . $idGestion . "' </strong> fue todo un éxito!";
            
            if($encabezadoDao->registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$llamada,$fortalezas,$oportunidades)) {
                
                for($i = 1; $i < 4; $i++){
                    $encabezadoDao->registrarValorSeccionEncabezado($idGestion,$i,$valor[$i]);                    
                }
                
                // Registrar promedio alcanzado por seccion
                if($errorCritico == 1){
                    $encabezadoDao->registrarPromedio_ie($idGestion,$acum_ies_input,$acum_iei_input,$acum_ier_input);
                } else {
                    $encabezadoDao->registrarPromedio_ie($idGestion, 0 , 0 , 0);
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
                
                $this->redireccion($mRPositivo);
                
            }else{
                
                $this->redireccion($mNegativo);
                
            }
        }
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/gestionIE.php?m=$pMensaje");
        }
    }

    $gestionIEC = new gestionIEControlador(); 
?>