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
        
        
        public function listarTabla(){
            try{
                $query = $this->conexion->prepare("CALL listarTablaAsesor();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function saberExistenciaUsuario($nom_usuario){
            try{
                $query = $this->conexion->prepare("CALL saberExistenciaUsuario('$nom_usuario');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarAsesorGestion($pUsuarioAsesor){
            try{
                $query = $this->conexion->prepare("CALL listarAsesorGestion('$pUsuarioAsesor');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemAsesor($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarAsesoresActivos(){
            try{
                $query = $this->conexion->prepare("call listarAsesoresActivos()"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
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
        
        // Listar promedio de Asesor
        public function listarPromedioAsesor($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesor('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>