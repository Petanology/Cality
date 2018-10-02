<?php
    require_once ("util/conexion.php");

    class valSeccDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        // Listar Tabla
        public function listarTabla($limite1,$limite2){
            try{
                $query = $this->conexion->prepare("CALL listarTablaValSecc($limite1,$limite2);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar Item
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemValSecc($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar
        public function actualizarItem($pIdValSecc,$pValorValSecc){
            try{
                $query = $this->conexion->prepare("call actualizarValSecc($pIdValSecc,$pValorValSecc)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>