<?php
    require_once ("util/conexion.php");

    class analistaDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarAnalista($pIdPersona,$pUsuarioAnalista,$pContrasenaAnalista) {
            try{
                $query = $this->conexion->prepare("CALL registrarAnalista($pIdPersona,'$pUsuarioAnalista','$pContrasenaAnalista');");
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
                $query = $this->conexion->prepare("CALL listarTablaAnalista();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item analista
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemAnalista($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar Analista
        public function actualizarItem($pIdPersona2,$pGeneroAnalista2,$pTipoDocAnalista2,$pNomsAnalista2,$pApesAnalista2,$pCorreoAnalista2,$pUsuarioAnalista2,$pEstadoAnalista2){
            try{
                $query = $this->conexion->prepare("call actualizarAnalista($pIdPersona2,$pGeneroAnalista2,$pTipoDocAnalista2,'$pNomsAnalista2','$pApesAnalista2','$pCorreoAnalista2','$pUsuarioAnalista2',$pEstadoAnalista2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>