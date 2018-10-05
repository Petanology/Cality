<?php
    require_once ("../modelo/gestionDao.php");
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    class gestionControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            // instancia al Dao
            $gestionDao = new gestionDao();
                    
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
                  
            $mRPositivo = "¡Felicidades, el registro <strong> '" . $idGestion . "' </strong> fue todo un éxito!";
            
            if($gestionDao->registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$valor1,$valor2,$valor3,$observacion)) {

                foreach($seccion1 as $aprobadoItem){
                    $gestionDao->registrarDCS($idGestion,$aprobadoItem[1],$aprobadoItem[0]);
                }
                
                $this->redireccion($mRPositivo);
                
            }else{
                
                $this->redireccion($mNegativo);
                
            }
        }
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/gestion.php?m=$pMensaje");
        }
    }

    $gestionC = new gestionControlador(); 
?>




