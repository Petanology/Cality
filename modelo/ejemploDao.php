<?php
    require_once ("util/conexion.php");

    class ejemploDao{ 
        
        private $conexion;        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
                // Listar Tabla
        public function ejemplo(){
            try{
                $query = $this->conexion->prepare("CALL ejemplo();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

    }
?>