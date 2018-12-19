<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/coordFinancieraDao.php");

    class coordFinancieraControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton =$_POST['boton']; // botón general
            
            $coordFinancieraDao = new coordFinancieraDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoCoordFinanciera = $_POST['genero'];
                    $tipoDocCoordFinanciera = $_POST['tipoDocumento'];
                    $nomsCoordFinanciera = $_POST['nombres'];
                    $apesCoordFinanciera = $_POST['apellidos'];
                    $correoCoordFinanciera = $_POST['correo'];
                    
                    
                    // variables para coordinador financiera
                    $usuarioCoordFinanciera = $_POST['usuario'];
                    $contrasenaCoordFinanciera = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoCoordFinanciera,$tipoDocCoordFinanciera,$nomsCoordFinanciera,$apesCoordFinanciera,$correoCoordFinanciera)) {
                        if($coordFinancieraDao->registrarCoordFinanciera($idPersona,$usuarioCoordFinanciera,$contrasenaCoordFinanciera)){
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
                    $generoCoordFinanciera2 = $_POST['genero2'];
                    $tipoDocCoordFinanciera2 = $_POST['tipoDocumento2'];
                    $nomsCoordFinanciera2 = $_POST['nombres2'];
                    $apesCoordFinanciera2 = $_POST['apellidos2'];
                    $correoCoordFinanciera2 = $_POST['correo2'];
                    
                    // variables para coord financiera
                    $usuarioCoordFinanciera2 = $_POST['usuario2'];
                    $estadoCoordFinanciera2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($coordFinancieraDao->actualizarItem($idPersona2,$generoCoordFinanciera2,$tipoDocCoordFinanciera2,$nomsCoordFinanciera2,$apesCoordFinanciera2,$correoCoordFinanciera2,$usuarioCoordFinanciera2,$estadoCoordFinanciera2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/coordFinanciera.php?m=$pMensaje");
        }
    }

    $coordFinancieraC = new coordFinancieraControlador(); 
?>