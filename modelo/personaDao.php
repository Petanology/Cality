<?php
    require_once ("util/conexion.php");

    class personaDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarPersona($pIdPersona,$pGenero,$pTipoDoc,$pNoms,$pApes,$pCorreo,$pImagen){
            try{
                $query = $this->conexion->prepare("CALL registrarPersona($pIdPersona,$pGenero,$pTipoDoc,'$pNoms','$pApes','$pCorreo','$pImagen');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function listarPersonasMixtos(){
            try{
                $query = $this->conexion->prepare("CALL listarPersonasMixtos();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPersonaFoto($nombre){
            try{
                $query = $this->conexion->prepare("CALL listarPersonaFoto('$nombre');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>