<?php

    require_once ("../modelo/personaDao.php");

    class imagenPerfilControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $personaDao = new personaDao();

            $identificacion = $_POST['identificacion'];
            $mPositivo = "¡Felicidades, la modificación de la foto de perfil para el usuario <strong>'$identificacion'</strong> fue todo un éxito!";
            $imagen = $_FILES['imagen']['tmp_name'];
            $ruta = "img/fotos_perfil/$identificacion.jpg";

            $objetoPersonaDao = new personaDao();
            if($objetoPersonaDao->actualizarRutaPersona($identificacion,$ruta)){
                if(is_file("../vista/" . $ruta)){
                    unlink("../vista/" . $ruta); // Eliminar del servidor img
                }
                move_uploaded_file($imagen,"../vista/" . $ruta); // mover archivo a la carpeta destino
                $this->redireccion($mPositivo);
            }else{
                $this->redireccion($mNegativo);
            }
        }
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/gestionFotosPerfil.php?m=$pMensaje");
        }
    }

    $objetoimagenPerfilC = new imagenPerfilControlador(); 
?>