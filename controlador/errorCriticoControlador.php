<?php

    require_once ("../modelo/errorCriticoDao.php");

    class errorCriticoControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
        
            // botón general
            $boton =$_POST['boton'];
            
            // instancia al Dao
            $errorCriticoDao = new errorCriticoDao();
            
            switch($boton){
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro <strong> '" . $_POST['nombre'] . "' </strong> fue todo un éxito!";
                    
                    $nomErrorCritico = $_POST['nombre'];
                    
                    if($errorCriticoDao->registrar($nomErrorCritico)) {
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
                                    
                    if($errorCriticoDao->actualizarItem($id2,$nombre2,$estado2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/errorCritico.php?m=$pMensaje");
        }
    }

    $errorCriticoC = new errorCriticoControlador(); 
?>