<?php
    require_once ("util/conexion.php");

    class generoDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        // Listar Tabla
        public function formGenero(){
            try{
                $query = $this->conexion->prepare("CALL formGenero();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item Genero
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemGenero($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>