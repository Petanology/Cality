<?php
    require_once ("util/conexion.php");

    class ItemDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        private $tabla;
        
        public function __construct($pTabla){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
            $this->tabla = $pTabla;
        }
        
        
        public function registrar($pTitulo,$pDescripcion){
            try{
                $query = $this->conexion->prepare("CALL registrarItems('$this->tabla','$pTitulo','$pDescripcion');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function actualizarItem($pId2,$pTitulo2,$pDescripcion2,$pEstado2){
            try{
                $query = $this->conexion->prepare("call actualizarItems('$this->tabla',$pId2,'$pTitulo2','$pDescripcion2',$pEstado2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
        
        
        // Listar Tabla
        public function listarTabla(){
            try{
                $query = $this->conexion->prepare("CALL listarTablaItems('$this->tabla');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemItems('$this->tabla',$pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>