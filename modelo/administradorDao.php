<?php
    require_once ("util/conexion.php");

    class administradorDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarAdministrador($pIdPersona,$pUsuarioAdministrador,$pContrasenaAdministrador) {
            try{
                $query = $this->conexion->prepare("CALL registrarAdministrador($pIdPersona,'$pUsuarioAdministrador','$pContrasenaAdministrador');");
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
                $query = $this->conexion->prepare("CALL listarTablaAdministrador();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item administrador
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemAdministrador($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar administrador
        public function actualizarItem($pIdPersona2,$pGeneroAdministrador2,$pTipoDocAdministrador2,$pNomsAdministrador2,$pApesAdministrador2,$pCorreoAdministrador2,$pUsuarioAdministrador2,$pEstadoAdministrador2){
            try{
                $query = $this->conexion->prepare("call actualizarAdministrador($pIdPersona2,$pGeneroAdministrador2,$pTipoDocAdministrador2,'$pNomsAdministrador2','$pApesAdministrador2','$pCorreoAdministrador2','$pUsuarioAdministrador2',$pEstadoAdministrador2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>