<?php
    require_once ("util/conexion.php");

    class gestionGeneralDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        private $tabla;
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarCalificacion($tablaRegistro,$campoRegistro,$idGestion,$pItem,$pAprobado){
            try{
                $query = $this->conexion->prepare("CALL registrarCalificacion('$tablaRegistro','$campoRegistro','$idGestion',$pItem,$pAprobado);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
    }
?>