<?php

    require_once ("../modelo/personaDao.php");
    require_once ("../modelo/coordVentaDirectaDao.php");

    class coordVentaDirectaControlador{

        public function __construct(){
            
            $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
            
            $boton = $_POST['boton'];
            
            $coordVentaDirectaDao = new coordVentaDirectaDao();
            $personaDao = new personaDao();
            
            switch($boton){
                    
                case "REGISTRAR":
                    
                    $mRPositivo = "¡Felicidades, el registro con la identificación <strong> '" . $_POST['identificacion'] . "' </strong> fue todo un éxito!";
                    
                    
                    // variables para tabla persona
                    $idPersona = $_POST['identificacion'];
                    $generoCoordVentaDirecta = $_POST['genero'];
                    $tipoDocCoordVentaDirecta = $_POST['tipoDocumento'];
                    $nomsCoordVentaDirecta = $_POST['nombres'];
                    $apesCoordVentaDirecta = $_POST['apellidos'];
                    $correoCoordVentaDirecta = $_POST['correo'];
                    
                    // traer archivo de la imagen
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $ruta = "img/fotos_perfil/$idPersona.jpg";
                    
                    // variables para coordinador de venta directa
                    $usuarioCoordVentaDirecta = $_POST['usuario'];
                    $contrasenaCoordVentaDirecta = $_POST['contrasena'];
                    
                    
                    if($personaDao->registrarPersona($idPersona,$generoCoordVentaDirecta,$tipoDocCoordVentaDirecta,$nomsCoordVentaDirecta,$apesCoordVentaDirecta,$correoCoordVentaDirecta,$ruta)) {
                        if($coordVentaDirectaDao->registrarCoordVentaDirecta($idPersona,$usuarioCoordVentaDirecta,$contrasenaCoordVentaDirecta)){
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
                    $generoCoordVentaDirecta2 = $_POST['genero2'];
                    $tipoDocCoordVentaDirecta2 = $_POST['tipoDocumento2'];
                    $nomsCoordVentaDirecta2 = $_POST['nombres2'];
                    $apesCoordVentaDirecta2 = $_POST['apellidos2'];
                    $correoCoordVentaDirecta2 = $_POST['correo2'];
                    
                    // variables para coordinador de venta directa
                    $usuarioCoordVentaDirecta2 = $_POST['usuario2'];
                    $estadoCoordVentaDirecta2 = $_POST['estado2'];
                    
                    $mMPositivo = "¡Felicidades, la modificación con la identificación <strong> '" . $_POST['identificacion2'] . "' </strong> fue todo un éxito!";
                                    
                    if($coordVentaDirectaDao->actualizarItem($idPersona2,$generoCoordVentaDirecta2,$tipoDocCoordVentaDirecta2,$nomsCoordVentaDirecta2,$apesCoordVentaDirecta2,$correoCoordVentaDirecta2,$usuarioCoordVentaDirecta2,$estadoCoordVentaDirecta2)) {
                        $this->redireccion($mMPositivo);
                    }else{
                        $this->redireccion($mNegativo);
                    }
                    
                    break;
            }
        }
        
        
        // redirección
        public function redireccion($pMensaje){
            header("location: ../vista/coordVentaDirecta.php?m=$pMensaje");
        }
    }

    $coordVentaDirectaC = new coordVentaDirectaControlador(); 
?>