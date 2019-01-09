<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/liderDao.php");

    class liderControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton = $_POST['boton'];
            
            $liderDao = new liderDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoLider = $_POST['genero'];
                    $tipoDocLider = $_POST['tipoDocumento'];
                    $nomsLider = $_POST['nombres'];
                    $apesLider = $_POST['apellidos'];
                    $correoLider = $_POST['correo'];
                    
                    // traer archivo de la imagen
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $ruta = "img/fotos_perfil/$idPersona.jpg";
                    
                    // variables para lider
                    $usuarioLider = $_POST['usuario'];
                    $contrasenaLider = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoLider,$tipoDocLider,$nomsLider,$apesLider,$correoLider,$ruta)) {
                        if($liderDao->registrarLider($idPersona,$usuarioLider,$contrasenaLider)){
                            // mover archivo a la carpeta destino
                            move_uploaded_file($imagen , "../vista/" . $ruta);
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
                    $generoLider2 = $_POST['genero2'];
                    $tipoDocLider2 = $_POST['tipoDocumento2'];
                    $nomsLider2 = $_POST['nombres2'];
                    $apesLider2 = $_POST['apellidos2'];
                    $correoLider2 = $_POST['correo2'];
                    
                    // variables para Lider
                    $usuarioLider2 = $_POST['usuario2'];
                    $estadoLider2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($liderDao->actualizarItem($idPersona2,$generoLider2,$tipoDocLider2,$nomsLider2,$apesLider2,$correoLider2,$usuarioLider2,$estadoLider2)) {
                        //$this->redireccion($mMPositivo);
                    }else{
                        //$this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/lider.php?m=$pMensaje");
        }
    }

    $liderC = new liderControlador(); 
?>