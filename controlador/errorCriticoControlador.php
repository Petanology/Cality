<?php

    require_once ("../modelo/errorCriticoDao.php");

    class errorCriticoControlador{
        
        private $mensajeP = "¡Felicidades, el registro/modificación fue todo un éxito!";
        private $mensajeN = "Lo sentimos, algo salió mal... intente nuevamente por favor";


        public function __construct(){
            
            $boton = $_POST['boton'];
            
            switch($boton){
                case "REGISTRAR":
                    $nomErrorCritico = $_POST['nombre'];
                    $errorCriticoDao = new errorCriticoDao();    
                    
                    if($errorCriticoDao->registrar($nomErrorCritico)) {
                        header("location: ../vista/errorCritico.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/errorCritico.php?m=$this->mensajeN");
                    }
                    break;
                
                case "MODIFICAR":
                    $id2 = $_POST['id2'];
                    $nombre2 = $_POST['nombre2'];
                    $estado2 = $_POST['estado2'];
                
                    $errorCriticoDao2 = new errorCriticoDao();
                    
                    if($errorCriticoDao2->actualizarItem($id2,$nombre2,$estado2)) {
                        header("location: ../vista/errorCritico.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/errorCritico.php?m=$this->mensajeN");
                    }
                    
                    break;
            }
        }
    }

    $errorCriticoC = new errorCriticoControlador(); 
?>