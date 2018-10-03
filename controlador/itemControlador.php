<?php

    require_once ("../modelo/itemDao.php");

    class itemControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
        
            $boton =$_POST['boton']; // botón general
            
            $itemDao = new itemDao($_POST['tabla']); // instancia al Dao
            
            switch($boton){
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro <strong> '" . $_POST['titulo'] . "' </strong> fue todo un éxito!";

                    $titulo = $_POST['titulo'];
                    $descripcion = $_POST['descripcion'];
                    
                    if($itemDao->registrar($titulo,$descripcion)) {
                        $this->redireccion($mRPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    break;
                
                case "MODIFICAR":
                    $id2 = $_POST['id2'];
                    $titulo2 = $_POST['titulo2']; 
                    $descripcion2 = $_POST['descripcion2'];
                    $estado2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con <strong> '" . $_POST['titulo2'] . "' </strong> fue todo un éxito!";
                                    
                    if($itemDao->actualizarItem($id2,$titulo2,$descripcion2,$estado2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/item" . $_POST['tabla'] . ".php?m=$pMensaje");
        }
    }

    $itemC = new itemControlador(); 
?>