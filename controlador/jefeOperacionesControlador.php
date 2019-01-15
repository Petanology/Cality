<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/jefeOperacionesDao.php");

    class jefeOperacionesControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";

            $boton = $_POST['boton'];
            
            $jefeOperacionesDao = new jefeOperacionesDao();
            $personaDao = new personaDao();
            
            switch($boton){

                case "REGISTRAR":

                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";

                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoJefeOperaciones = $_POST['genero'];
                    $tipoDocJefeOperaciones = $_POST['tipoDocumento'];
                    $nomsJefeOperaciones = $_POST['nombres'];
                    $apesJefeOperaciones = $_POST['apellidos'];
                    $correoJefeOperaciones = $_POST['correo'];
                    
                    // traer archivo de la imagen
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $ruta = "img/fotos_perfil/$idPersona.jpg";

                    // variables para jefe de operaciones
                    $usuarioJefeOperaciones = $_POST['usuario'];
                    $contrasenaJefeOperaciones = $_POST['contrasena'];


                    if($personaDao->registrarPersona($idPersona,$generoJefeOperaciones,$tipoDocJefeOperaciones,$nomsJefeOperaciones,$apesJefeOperaciones,$correoJefeOperaciones,$ruta)) {
                        if($jefeOperacionesDao->registrarJefeOperaciones($idPersona,$usuarioJefeOperaciones,$contrasenaJefeOperaciones)){
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
                    $generoJefeOperaciones2 = $_POST['genero2'];
                    $tipoDocJefeOperaciones2 = $_POST['tipoDocumento2'];
                    $nomsJefeOperaciones2 = $_POST['nombres2'];
                    $apesJefeOperaciones2 = $_POST['apellidos2'];
                    $correoJefeOperaciones2 = $_POST['correo2'];
                    
                    // variables para Jefe de operaciones
                    $usuarioJefeOperaciones2 = $_POST['usuario2'];
                    $estadoJefeOperaciones2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($jefeOperacionesDao->actualizarItem($idPersona2,$generoJefeOperaciones2,$tipoDocJefeOperaciones2,$nomsJefeOperaciones2,$apesJefeOperaciones2,$correoJefeOperaciones2,$usuarioJefeOperaciones2,$estadoJefeOperaciones2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/jefeOperaciones.php?m=$pMensaje");
        }
    }

    $jefeOperacionesC = new jefeOperacionesControlador(); 
?>