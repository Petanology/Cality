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
        
        
        // listar item Unidad DC
        public function listarRankingUnidadDC($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadDC('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item Unidad DP
        public function listarRankingUnidadDP($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadDP('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        // listar item Unidad IE
        public function listarRankingUnidadIE($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadIE('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar item Unidad IB
        public function listarRankingUnidadIB($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadIB('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar item Unidad NEG
        public function listarRankingUnidadNEG($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadNEG('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar item Unidad MEN
        public function listarRankingUnidadMEN($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadMEN('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar item Unidad IBF
        public function listarRankingUnidadIBF($mes){
            try{
                $query = $this->conexion->prepare("call listarRankingUnidadIBF('$mes%')"); 
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