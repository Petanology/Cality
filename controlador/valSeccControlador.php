<?php

    require_once ("../modelo/valSeccDao.php");

    class valSeccControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton =$_POST['boton']; // botón general
            
            $valSeccDao = new valSeccDao();
            
            switch($boton){
                case "MODIFICAR":
                    // variables para tabla persona
                    $identificacion2 = $_POST['identificacion2'];
                    $valor2 = $_POST['valor2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($valSeccDao->actualizarItem($identificacion2,$valor2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/valSecc.php?m=$pMensaje");
        }
    }

    $valSecc = new valSeccControlador(); 
?>