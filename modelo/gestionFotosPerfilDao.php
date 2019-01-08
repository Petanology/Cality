<?php
    require_once ("util/conexion.php");

    class gestionFotosPerfilDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        // Listar Persona
        public function listarPersonaImg(){
            try{
                $query = $this->conexion->prepare("CALL listarPersonaImg('');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>