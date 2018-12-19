<?php
    require_once ("util/conexion.php");

    class coordFinancieraDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarCoordFinanciera($pIdPersona,$pUsuarioCoordFinanciera,$pContrasenaCoordFinanciera) {
            try{
                $query = $this->conexion->prepare("CALL registrarCoordFinanciera($pIdPersona,'$pUsuarioCoordFinanciera','$pContrasenaCoordFinanciera');");
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
                $query = $this->conexion->prepare("CALL listarTablaCoordFinanciera();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item coordinador financiero
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemCoordFinanciera($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar Coordinador financiera
        public function actualizarItem($pIdPersona2,$pGeneroCoordFinanciera2,$pTipoDocCoordFinanciera2,$pNomsCoordFinanciera2,$pApesCoordFinanciera2,$pCorreoCoordFinanciera2,$pUsuarioCoordFinanciera2,$pEstadoCoordFinanciera2){
            try{
                $query = $this->conexion->prepare("call actualizarCoordFinanciera($pIdPersona2,$pGeneroCoordFinanciera2,$pTipoDocCoordFinanciera2,'$pNomsCoordFinanciera2','$pApesCoordFinanciera2','$pCorreoCoordFinanciera2','$pUsuarioCoordFinanciera2',$pEstadoCoordFinanciera2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>