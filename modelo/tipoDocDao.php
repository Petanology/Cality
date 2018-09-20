<?php
    require_once ("util/conexion.php");

    class tipoDocDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrar($pRegistrar){
            try{
                $query = $this->conexion->prepare("CALL registrarTipoDoc('$pRegistrar');");
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
                $query = $this->conexion->prepare("CALL listarTablaTipoDoc();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function formTipoDoc(){
            try{
                $query = $this->conexion->prepare("CALL formTipoDoc();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item tipo documento
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemTipoDoc($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar tipo documento
        public function actualizarItem($pId,$pNombre,$pEstado){
            try{
                $query = $this->conexion->prepare("call actualizarTipoDoc($pId,'$pNombre',$pEstado)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>