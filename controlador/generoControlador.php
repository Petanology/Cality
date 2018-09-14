<?php

    require_once ("../modelo/generoDao.php");

    class generoControlador{

        private $mensajeP = "¡Felicidades, el registro/modificación fue todo un éxito!";
        private $mensajeN = "Lo sentimos, algo salió mal... intente nuevamente por favor";

        public function __construct(){
            
            $boton = $_POST['boton'];
            
            switch($boton){
                case "REGISTRAR":
                    $nomGenero = $_POST['nombre'];
                    $generoDao = new generoDao();    
                    
                    if($generoDao->registrar($nomGenero)) {
                        header("location: ../vista/genero.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/genero.php?m=$this->mensajeN");
                    }
                    break;
                
                case "MODIFICAR":
                    $id2 = $_POST['id2'];
                    $nombre2 = $_POST['nombre2'];
                    $estado2 = $_POST['estado2'];
                
                    $generoDao2 = new generoDao();
                    
                    if($generoDao2->actualizarItem($id2,$nombre2,$estado2)) {
                        header("location: ../vista/genero.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/genero.php?m=$this->mensajeN");
                    }
                    
                    break;
            }
        }
    }

    $generoC = new generoControlador(); 
?>