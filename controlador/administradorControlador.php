<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/administradorDao.php");

    class administradorControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton =$_POST['boton']; // botón general
            
            $administradorDao = new administradorDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoAdministrador = $_POST['genero'];
                    $tipoDocAdministrador = $_POST['tipoDocumento'];
                    $nomsAdministrador = $_POST['nombres'];
                    $apesAdministrador = $_POST['apellidos'];
                    $correoAdministrador = $_POST['correo'];
                    
                    
                    // variables para administrador
                    $usuarioAdministrador = $_POST['usuario'];
                    $contrasenaAdministrador = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoAdministrador,$tipoDocAdministrador,$nomsAdministrador,$apesAdministrador,$correoAdministrador)) {
                        if($administradorDao->registrarAdministrador($idPersona,$usuarioAdministrador,$contrasenaAdministrador)){
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
                    $generoAdministrador2 = $_POST['genero2'];
                    $tipoDocAdministrador2 = $_POST['tipoDocumento2'];
                    $nomsAdministrador2 = $_POST['nombres2'];
                    $apesAdministrador2 = $_POST['apellidos2'];
                    $correoAdministrador2 = $_POST['correo2'];
                    
                    // variables para administrador
                    $usuarioAdministrador2 = $_POST['usuario2'];
                    $estadoAdministrador2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($administradorDao->actualizarItem($idPersona2,$generoAdministrador2,$tipoDocAdministrador2,$nomsAdministrador2,$apesAdministrador2,$correoAdministrador2,$usuarioAdministrador2,$estadoAdministrador2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/administrador.php?m=$pMensaje");
        }
    }

    $administradorC = new administradorControlador(); 
?>