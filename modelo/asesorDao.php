<?php
    require_once ("util/conexion.php");

    class asesorDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarAsesor($pIdPersona,$pLiderAsesor,$pUsuarioAsesor,$pContrasenaAsesor) {
            try{
                $query = $this->conexion->prepare("CALL registrarAsesor($pIdPersona,$pLiderAsesor,'$pUsuarioAsesor','$pContrasenaAsesor');");
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
                $query = $this->conexion->prepare("CALL listarTablaAsesor();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item asesor
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemAsesor($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar asesor
        public function actualizarItem($pIdPersona2,$pGeneroAsesor2,$pTipoDocAsesor2,$pNomsAsesor2,$pApesAsesor2,$pCorreoAsesor2,$pLiderAsesor2,$pUsuarioAsesor2,$pEstadoAsesor2){
            try{
                $query = $this->conexion->prepare("call actualizarAsesor($pIdPersona2,$pGeneroAsesor2,$pTipoDocAsesor2,'$pNomsAsesor2','$pApesAsesor2','$pCorreoAsesor2',$pLiderAsesor2,'$pUsuarioAsesor2',$pEstadoAsesor2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>