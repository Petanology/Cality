<?php
    require_once ("../modelo/encabezadoDao.php");
    require_once ("../modelo/gestionGeneralDao.php");
    require_once ("../controlador/sesiones.php");

    $sss = new sesiones();
    $sss->iniciar();

    class gestionDPControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            // instancia al Dao
            $encabezadoDao = new encabezadoDao();
            $gestionGeneralDao = new gestionGeneralDao();
                    
            // Variables
            $fecha = $_POST["fecha"];
            $idGestion = $_POST["identificacion"]."-".$fecha; // id
            $tipoMonitoreo = $_POST["tipo-monitoreo"];
            $errorCritico = $_POST["error-critico"];
            $unidad = $_POST["unidad"];
            $asesor = $_POST["identificacion"];
            $analista = $_SESSION["idpersona"];
            $observacion = $_POST["observacion"];
            $totalItemsDPS = $_POST["totalItemsDPS"];
            $totalItemsDPN = $_POST["totalItemsDPN"]; 
            $totalItemsDPR = $_POST["totalItemsDPR"];
            $primerCampo = "dps";
            $segundoCampo = "dpn";
            $tercerCampo = "dpr";
            $primeraTabla = "dir_pre_set";
            $segundaTabla = "dir_pre_n";
            $terceraTabla = "dir_pre_rs";
            
            $valor[1] = $_POST["valorSeccionTabla1"];
            $valor[2] = $_POST["valorSeccionTabla2 "];
            $valor[3] = $_POST["valorSeccionTabla3"];

            /* ************************** */
            
            $seccion1 = array();
            $i = 1; // numero items
            $f = 1; // repeticiones bucle
            
            while($f <= $totalItemsDPS){
                if(isset($_POST["dps_".$i])){
                    $seccion1[$i][0] = $_POST["dps_".$i];
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
            
            while($f2 <= $totalItemsDPN){
                if(isset($_POST["dpn_".$i2])){
                    $seccion2[$i2][0] = $_POST["dpn_".$i2];
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
            
            while($f3 <= $totalItemsDPR){
                if(isset($_POST["dpr_".$i3])){
                    $seccion3[$i3][0] = $_POST["dpr_".$i3];
                    $seccion3[$i3][1] = $i3;
                    $f3++;
                }else{
                }
                $i3++;
            }
            
            /* ************************** */
            
            $mRPositivo = "¡Felicidades, el registro <strong> '" . $idGestion . "' </strong> fue todo un éxito!";
            
            if($encabezadoDao->registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$observacion)) {
                
                // Registrar al seccion
                for($i = 1; $i < 4; $i++){
                    $encabezadoDao->registrarValorSeccionEncabezado($idGestion,$i,$valor[$i]);                    
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
            header("location: ../vista/gestionDP.php?m=$pMensaje");
        }
    }

    $gestionDPC = new gestionDPControlador(); 
?>