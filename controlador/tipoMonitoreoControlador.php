<?php

    require_once ("../modelo/tipoMonitoreoDao.php");


    class tipoMonitoreoControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
        
            // botón general
            $boton =$_POST['boton'];
            
            // instancia al Dao
            $tipoMonitoreoDao = new tipoMonitoreoDao();
            
            switch($boton){
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro <strong> '" . $_POST['nombre'] . "' </strong> fue todo un éxito!";
                    
                    $nomTipoMonitoreo = $_POST['nombre'];
                    
                    if($tipoMonitoreoDao->registrar($nomTipoMonitoreo)) {
                        $this->redireccion($mRPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    break;
                
                case "MODIFICAR":
                    $id2 = $_POST['id2']; 
                    $nombre2 = $_POST['nombre2']; 
                    $estado2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con <strong> '" . $_POST['nombre2'] . "' </strong> fue todo un éxito!";
                                    
                    if($tipoMonitoreoDao->actualizarItem($id2,$nombre2,$estado2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/tipoMonitoreo.php?m=$pMensaje");
        }
    }

    $tipoMonitoreoC = new tipoMonitoreoControlador(); 
?>