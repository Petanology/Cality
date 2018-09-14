<?php

    require_once ("../modelo/tipoDocDao.php");

    class tipoDocControlador{
        
        private $mensajeP = "¡Felicidades, el registro/modificación fue todo un éxito!";
        private $mensajeN = "Lo sentimos, algo salió mal... intente nuevamente por favor";

        public function __construct(){
            
            $boton = $_POST['boton'];
            
            switch($boton){
                case "REGISTRAR":
                    $nomTipoDoc = $_POST['nombre'];
                    $tipoDocDao = new tipoDocDao();    
                    
                    if($tipoDocDao->registrar($nomTipoDoc)) {
                        header("location: ../vista/tipoDoc.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/tipoDoc.php?m=$this->mensajeN");
                    }
                    break;
                
                case "MODIFICAR":
                    $id2 = $_POST['id2'];
                    $nombre2 = $_POST['nombre2'];
                    $estado2 = $_POST['estado2'];
                
                    $tipoDocDao2 = new tipoDocDao();
                    
                    if($tipoDocDao2->actualizarItem($id2,$nombre2,$estado2)) {
                        header("location: ../vista/tipoDoc.php?m=$this->mensajeP");
                    }else{
                        header("location: ../vista/tipoDoc.php?m=$this->mensajeN");
                    }
                    
                    break;
            }
        }
    }

    $tipoDocC = new tipoDocControlador(); 
?>