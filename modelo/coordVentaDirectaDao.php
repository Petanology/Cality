<?php
    require_once ("util/conexion.php");

    class coordVentaDirectaDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarCoordVentaDirecta($pIdPersona,$pUsuarioCoordVentaDirecta,$pContrasenaCoordVentaDirecta) {
            try{
                $query = $this->conexion->prepare("CALL registrarCoordVentaDirecta($pIdPersona,'$pUsuarioCoordVentaDirecta','$pContrasenaCoordVentaDirecta');");
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
                $query = $this->conexion->prepare("CALL listarTablaCoordVentaDirecta();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item coordinador de venta directa
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemCoordVentaDirecta($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar coordinador de venta directa
        public function actualizarItem($pIdPersona2,$pGeneroCoordVentaDirecta2,$pTipoDocCoordVentaDirecta2,$pNomsCoordVentaDirecta2,$pApesCoordVentaDirecta2,$pCorreoCoordVentaDirecta2,$pUsuarioCoordVentaDirecta2,$pEstadoCoordVentaDirecta2){
            try{
                $query = $this->conexion->prepare("call actualizarCoordVentaDirecta($pIdPersona2,$pGeneroCoordVentaDirecta2,$pTipoDocCoordVentaDirecta2,'$pNomsCoordVentaDirecta2','$pApesCoordVentaDirecta2','$pCorreoCoordVentaDirecta2','$pUsuarioCoordVentaDirecta2',$pEstadoCoordVentaDirecta2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
    }
?>