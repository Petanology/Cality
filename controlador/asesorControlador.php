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
                    
                    
                
                case "MODIFICAR":
                    // variables para tabla persona
                    $idPersona2 = $_POST['identificacion2'];
                    $generoAsesor2 = $_POST['genero2'];
                    $tipoDocAsesor2 = $_POST['tipoDocumento2'];
                    $nomsAsesor2 = $_POST['nombres2'];
                    $apesAsesor2 = $_POST['apellidos2'];
                    $correoAsesor2 = $_POST['correo2'];
                    
                    // variables para asesor
                    $liderAsesor2 = $_POST['lider2'];
                    $usuarioAsesor2 = $_POST['usuario2'];
                    $estadoAsesor2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($asesorDao->actualizarItem($idPersona2,$generoAsesor2,$tipoDocAsesor2,$nomsAsesor2,$apesAsesor2,$correoAsesor2,$liderAsesor2,$usuarioAsesor2,$estadoAsesor2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/asesor.php?m=$pMensaje");
        }
    }

    $asesorC = new asesorControlador(); 
?>