<?php
    require_once ("util/conexion.php");

    class jefeOperacionesDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarJefeOperaciones($pIdPersona,$pUsuarioJefeOperaciones,$pContrasenaJefeOperaciones) {
            try{
                $query = $this->conexion->prepare("CALL registrarJefeOperaciones($pIdPersona,'$pUsuarioJefeOperaciones','$pContrasenaJefeOperaciones');");
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
                $query = $this->conexion->prepare("CALL listarTablaJefeOperaciones();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item jefe operaciones
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemJefeOperaciones($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar jede de operaciones
        public function actualizarItem($pIdPersona2,$pGeneroJefeOperaciones2,$pTipoDocJefeOperaciones2,$pNomsJefeOperaciones2,$pApesJefeOperaciones2,$pCorreoJefeOperaciones2,$pUsuarioJefeOperaciones2,$pEstadoJefeOperaciones2){
            try{
                $query = $this->conexion->prepare("call actualizarJefeOperaciones($pIdPersona2,$pGeneroJefeOperaciones2,$pTipoDocJefeOperaciones2,'$pNomsJefeOperaciones2','$pApesJefeOperaciones2','$pCorreoJefeOperaciones2','$pUsuarioJefeOperaciones2',$pEstadoJefeOperaciones2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>