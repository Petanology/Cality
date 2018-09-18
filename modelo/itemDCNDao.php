<?php
    require_once ("util/conexion.php");

    class ItemDCNDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrar($pRegistrar){
            try{
                $query = $this->conexion->prepare("CALL registrarItemDCN('$pRegistrar');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        // Listar Tabla
        public function listarTabla(){
            try{
                $query = $this->conexion->prepare("CALL listarTablaItemDCN();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item ItemDCN
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemItemDCN($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar ItemDCN
        public function actualizarItem($pId,$pNombre,$pEstado){
            try{
                $query = $this->conexion->prepare("call actualizarItemDCN($pId,'$pNombre',$pEstado)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>