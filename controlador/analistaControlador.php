<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/analistaDao.php");

    class analistaControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";

            $boton = $_POST['boton'];
            
            $analistaDao = new analistaDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoAnalista = $_POST['genero'];
                    $tipoDocAnalista = $_POST['tipoDocumento'];
                    $nomsAnalista = $_POST['nombres'];
                    $apesAnalista = $_POST['apellidos'];
                    $correoAnalista = $_POST['correo'];
                    
// traer archivo de la imagen
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $ruta = "img/fotos_perfil/$idPersona.jpg";
                    
                    
                    // variables para analista
                    $usuarioAnalista = $_POST['usuario'];
                    $contrasenaAnalista = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoAnalista,$tipoDocAnalista,$nomsAnalista,$apesAnalista,$correoAnalista,$ruta)) {
                        if($analistaDao->registrarAnalista($idPersona,$usuarioAnalista,$contrasenaAnalista)){
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
                    $generoAnalista2 = $_POST['genero2'];
                    $tipoDocAnalista2 = $_POST['tipoDocumento2'];
                    $nomsAnalista2 = $_POST['nombres2'];
                    $apesAnalista2 = $_POST['apellidos2'];
                    $correoAnalista2 = $_POST['correo2'];
                    
                    // variables para analista
                    $usuarioAnalista2 = $_POST['usuario2'];
                    $estadoAnalista2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($analistaDao->actualizarItem($idPersona2,$generoAnalista2,$tipoDocAnalista2,$nomsAnalista2,$apesAnalista2,$correoAnalista2,$usuarioAnalista2,$estadoAnalista2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/analista.php?m=$pMensaje");
        }
    }

    $analistaC = new analistaControlador(); 
?>