<?php
    require_once ("../modelo/encabezadoDao.php");
    require_once ("../modelo/gestionGeneralDao.php");
    require_once ("../controlador/sesiones.php");

    $sss = new sesiones();
    $sss->iniciar();

    class gestionDCControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            // instancia al Dao
            $encabezadoDao = new encabezadoDao();
            $gestionGeneralDao = new gestionGeneralDao();
                    
            // variables
            $fecha = $_POST["fecha"];
            $idGestion = $_POST["identificacion"] . "-" . $fecha; // id
            $tipoMonitoreo = $_POST["tipo-monitoreo"];
            $errorCritico = $_POST["error-critico"];
            $unidad = $_POST["unidad"];
            $asesor = $_POST["identificacion"];
            $analista = $_SESSION["idpersona"];
            $valor1 = $_POST["valorSeccionTabla1"];
            $valor2 = $_POST["valorSeccionTabla2"];
            $valor3 = $_POST["valorSeccionTabla3"];
            $observacion = $_POST["observacion"];
            
            $totalItemsDCS = $_POST["totalItemsDCS"];
            $totalItemsDCN = $_POST["totalItemsDCN"]; 
            $totalItemsDCR = $_POST["totalItemsDCR"];
            
            $primerCampo = "dcs";
            $segundoCampo = "dcn";
            $tercerCampo = "dcr";
            
            $primeraTabla = "dir_com_set";
            $segundaTabla = "dir_com_n";
            $terceraTabla = "dir_com_rs";
            
            $seccion1 = array();
            $i = 1; // numero items
            $f = 1; // repeticiones bucle
            
            while($f <= $totalItemsDCS){
                if(isset($_POST["dcs_".$i])){
                    $seccion1[$i][0] = $_POST["dcs_".$i];
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
            
            while($f2 <= $totalItemsDCN){
                if(isset($_POST["dcn_".$i2])){
                    $seccion2[$i2][0] = $_POST["dcn_".$i2];
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
            
            while($f3 <= $totalItemsDCR){
                if(isset($_POST["dcn_".$i3])){
                    $seccion3[$i3][0] = $_POST["dcn_".$i3];
                    $seccion3[$i3][1] = $i3;
                    $f3++;
                }else{
                }
                $i3++;
            }
            
            $mRPositivo = "¡Felicidades, el registro <strong> '" . $idGestion . "' </strong> fue todo un éxito!";
            
            if($encabezadoDao->registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$valor1,$valor2,$valor3,$observacion)) {

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
            header("location: ../vista/gestionDC.php?m=$pMensaje");
        }
    }

    $gestionDCC = new gestionDCControlador(); 
?>




