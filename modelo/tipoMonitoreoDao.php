<?php
    require_once ("util/conexion.php");

    class tipoMonitoreoDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrar($pRegistrar){
            try{
                $query = $this->conexion->prepare("CALL registrarTipoMonitoreo('$pRegistrar');");
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
                $query = $this->conexion->prepare("CALL listarTablaTipoMonitoreo();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        
        // Listar Tipos Monitoreos Activos
        public function tiposMonitoreosActivos(){
            try{
                $query = $this->conexion->prepare("CALL tiposMonitoreosActivos();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item tipo monitoreo
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemTipoMonitoreo($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar tipo monitoreo
        public function actualizarItem($pId,$pNombre,$pEstado){
            try{
                $query = $this->conexion->prepare("call actualizarTipoMonitoreo($pId,'$pNombre',$pEstado)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>