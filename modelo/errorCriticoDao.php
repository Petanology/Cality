<?php
    require_once ("util/conexion.php");

    class errorCriticoDao{ 
        
        private $registro = true;
        
        public function registrar($pRegistrar){
            
            $conn = Conexion::getConexion();
            
            try{
                
                $query = $conn->prepare("CALL registrarErrorCritico('$pRegistrar');");
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
                
                $query = $conn->prepare("CALL listarTablaErrorCritico();");
                $query->execute();
                return $query;
                $query = null;
                
            }catch(Exception $e){
                
                echo "Error: " . $e->getMessage();
            }
            
            return $this->registro;
        }
        
        
        
        // listar item error critico
        public static function listarItem($pItem){
            
            $conn = Conexion::getConexion();
            
            try{
                $query = $conn->prepare("call listarItemErrorCritico($pItem)"); 
                $query->execute();
                return $query;
                $query = null;
                
            }catch(Exception $e){

                echo "Error: " . $e->getMessage();

            }
        }
        
        
        // Actualizar error critico
        public static function actualizarItem($pId,$pNombre,$pEstado){
            
            $conn = Conexion::getConexion();
            
            try{
                $query = $conn->prepare("call actualizarErrorCritico($pId,'$pNombre',$pEstado)"); 
                $query->execute();
                return $query;
                $query = null;
            }catch(Exception $e){
                
                echo "Error: " . $e->getMessage();
                    
            }
        }

    }
?>