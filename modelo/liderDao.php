<?php
    require_once ("util/conexion.php");

    class liderDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        // Listar Tabla
        public function formLider(){
            try{
                $query = $this->conexion->prepare("CALL formLider();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>