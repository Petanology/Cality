<?php
    require_once ("util/conexion.php");

    class tipoMonitoreoDao{ 
        
        private $registro = true;
        
        public function registrar($pRegistrar){
            
            $conn = Conexion::getConexion();
            
            try{
                
                $query = $conn->prepare("CALL registrarTipoMonitoreo('$pRegistrar');");
                $query->execute();
                $query = null;
                
            }catch(Exception $e){
                
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            
            }
            
            return $this->registro;
        }
        
        
        // Listar Tabla
        public static function listarTabla(){
            
            $conn = Conexion::getConexion();
            
            try{
                
                $query = $conn->prepare("CALL listarTablaTipoDoc();");
                $query->execute();
                return $query;
                $query = null;
                
            }catch(Exception $e){
                
                echo "Error: " . $e->getMessage();
            }
            
            return $this->registro;
        }
        
        
        
        // listar item tipo documento
        public static function listarItem($pItem){
            
            $conn = Conexion::getConexion();
            
            try{
                $query = $conn->prepare("call listarItemTipoDoc($pItem)"); 
                $query->execute();
                return $query;
                $query = null;
                
            }catch(Exception $e){

                echo "Error: " . $e->getMessage();

            }
        }
        
        
        // Actualizar tipo documento
        public static function actualizarItem($pId,$pNombre,$pEstado){
            
            $conn = Conexion::getConexion();
            
            try{
                $query = $conn->prepare("call actualizarTipoDoc($pId,'$pNombre',$pEstado)"); 
                $query->execute();
                return $query;
                $query = null;
            }catch(Exception $e){
                
                echo "Error: " . $e->getMessage();
                    
            }
        }

    }
?>