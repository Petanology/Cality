<?php
    require_once ("util/conexion.php");

    class loginDao{
        
        public $conexion = null;
        
        
        public function __construct(){
            $objetoConexion = new Conexion(); // Objeto de conexión
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function login($prol,$pusuario,$pcontrasena){            
            try{
                $query = $this->conexion->prepare("call logear('$prol','$pusuario','$pcontrasena')");
                $query->execute();
                return $query->fetch();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>