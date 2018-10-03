<?php

    require_once ("../modelo/gestionDao.php");

    class gestionControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            // instancia al Dao
            //$gestionDao = new gestionDao();
            
                    //$mRPositivo = "¡Felicidades, el registro <strong> '" . $_POST['nombre'] . "' </strong> fue todo un éxito!";
                    
                    // variables
                    $idGestion = $_POST["identificacion"] . "-" . date("Y-m-d");
                    echo $idGestion;
                    /*$tipoMonitoreo = $_POST['tipo-monitoreo'];
                    $i = $_POST['nombre'];
                    $nomTipoDoc = $_POST['nombre'];
                    $nomTipoDoc = $_POST['nombre'];
                    
                    if($tipoDocDao->registrar($nomTipoDoc)) {
                        $this->redireccion($mRPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    break;*/
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/gestion.php?m=$pMensaje");
        }
    }

    $gestionC = new gestionControlador(); 
?>