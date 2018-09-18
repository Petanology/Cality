<?php

    require_once ("../modelo/unidadDao.php");

    class unidadControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
        
            // botón general
            $boton =$_POST['boton'];
            
            // instancia al Dao
            $unidadDao = new unidadDao();
            
            switch($boton){
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro <strong> '" . $_POST['nombre'] . "' </strong> fue todo un éxito!";
                    
                    $nomUnidad = $_POST['nombre'];
                    
                    if($unidadDao->registrar($nomUnidad)) {
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
                                    
                    if($unidadDao->actualizarItem($id2,$nombre2,$estado2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/unidad.php?m=$pMensaje");
        }
    }

    $unidadC = new unidadControlador(); 
?>