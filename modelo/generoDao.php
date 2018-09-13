<?php
    require_once ("util/conexion.php");

    class generoDao{ 
        
        private $registro = true;
        
        public function registrar($pRegistrar){
            
            $conn = Conexion::getConexion();
            
            try{
                
                $query = $conn->prepare("CALL registrarGenero('$pRegistrar');");
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
                
                $query = $conn->prepare("CALL listarTablaGenero();");
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
                $query = $conn->prepare("call listarItemGenero($pItem)"); 
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
                $query = $conn->prepare("call actualizarGenero($pId,'$pNombre',$pEstado)"); 
                $query->execute();
                return $query;
                $query = null;
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                    
            }
        }

    }
?>