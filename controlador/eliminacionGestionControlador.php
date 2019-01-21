<?php

    require_once ("../modelo/gestionGeneralDao.php");

    class eliminacionGestionControlador{

        public function __construct(){
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";

            $boton = $_POST['boton-eliminar'];
            
            $gestionGeneralDao = new gestionGeneralDao();
            
            $mRPositivo = "¡La gestión con la identificación <strong> '" . $_POST['boton-eliminar'] . "' </strong> ha sido <strong>eliminada</strong>!";

            if($gestionGeneralDao->eliminarGestion($boton)) {
                $this->redireccion($mRPositivo);
            }else{
                $this->redireccion($mNegativo);
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/visualizacionGeneral.php?m=$pMensaje");
        }
    }

    $eliminacionGC = new eliminacionGestionControlador(); 
?>