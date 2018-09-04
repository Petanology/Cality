<?php
    require_once ("util/conexion.php");

    class loginDao{
        private $registro = true;
        
        public function login($prol,$pusuario,$pcontrasena){
            $conn = Conexion::getConexion();
            
            try{
                // Llamada a Procedimiento Almacenado
                $query = $conn->prepare("call logear('$prol','$pusuario','$pcontrasena')");
                $query->execute();
                return $query->fetch();
                
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>