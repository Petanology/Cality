<?php
    require_once ("util/conexion.php");

    class generarPDFDao{ 
        
        
        private $conexion;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        public function listarPrimerValorGrupoDC($fecha_mes) {
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoDC('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>