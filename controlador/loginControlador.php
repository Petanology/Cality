<?php
    // importaciones necesarias
    require_once ("../modelo/loginDao.php");
    require_once ("sesiones.php");
    
    class loginControlador{
        private $mensaje;
        
        public function __construct(){
            
            // instancia a Modelo
            $loginDao = new loginDao();
            
            // variables de formulario
            $rolForm = $_POST['rol'];
            $usuarioForm = $_POST['usuario'];
            $contraForm = $_POST['contrasena'];

            
            // Se llama el metodo de iniciar sesión
            $rlogin = $loginDao->login($rolForm,$usuarioForm,$contraForm);
            
            if(empty($rlogin)){
                $this->mensaje = "Por favor verifique los datos ingresados...";
                header("location: ../vista/index.php?m=$this->mensaje&usu=$usuarioForm&rol=$rolForm");
            }else{
                $sss = new sesiones(); // instancia a clase de sesiones
                $sss->iniciar();
                $sss->set('usuario',$rlogin[0]);
                $sss->set('idpersona',$rlogin[1]);
                $sss->set('nombres',$rlogin[2]);
                $sss->set('genero',$rlogin[3]);               
                $sss->set('correo',$rlogin[4]);                
                $sss->set('autenticado','1');
                $sss->set('rol',$rolForm);
                header("location: ../vista/inicio");
            }
        }
    }

    $loginC = new loginControlador();

?>