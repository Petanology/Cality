<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/asesorDao.php");

    class asesorControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton =$_POST['boton']; // botón general
            
            $asesorDao = new asesorDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoAsesor = $_POST['genero'];
                    $tipoDocAsesor = $_POST['tipoDocumento'];
                    $nomsAsesor = $_POST['nombres'];
                    $apesAsesor = $_POST['apellidos'];
                    $correoAsesor = $_POST['correo'];
                    
                    
                    // variables para asesor
                    $liderAsesor = $_POST['lider'];
                    $usuarioAsesor = $_POST['usuario'];
                    $contrasenaAsesor = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoAsesor,$tipoDocAsesor,$nomsAsesor,$apesAsesor,$correoAsesor)) {
                        if($asesorDao->registrarAsesor($idPersona,$liderAsesor,$usuarioAsesor,$contrasenaAsesor)){
                            $this->redireccion($mRPositivo);
                        }else{
                            $this->redireccion($mNegativo);
                        }
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
                    
                    
                /*
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
                */
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/asesor.php?m=$pMensaje");
        }
    }

    $asesorC = new asesorControlador(); 
?>