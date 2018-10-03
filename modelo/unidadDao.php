<?php
    require_once ("util/conexion.php");

    class unidadDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrar($pRegistrar){
            try{
                $query = $this->conexion->prepare("CALL registrarUnidad('$pRegistrar');");
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
                $query = $this->conexion->prepare("CALL listarTablaUnidad();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar Unidades Activas
        public function listarUnidadesActivas(){
            try{
                $query = $this->conexion->prepare("CALL listarUnidadesActivas();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item Unidad
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemUnidad($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar Unidad
        public function actualizarItem($pId,$pNombre,$pEstado){
            try{
                $query = $this->conexion->prepare("call actualizarUnidad($pId,'$pNombre',$pEstado)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>