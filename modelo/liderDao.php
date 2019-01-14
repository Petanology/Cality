<?php
    require_once ("util/conexion.php");

    class liderDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarLider($pIdPersona,$pUsuarioLider,$pContrasenaLider,$pPiso) {
            try{
                $query = $this->conexion->prepare("CALL registrarLider($pIdPersona,'$pUsuarioLider','$pContrasenaLider',$pPiso);");
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
                $query = $this->conexion->prepare("CALL listarTablaLider();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar item
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemLider($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // Listar Tabla
        public function formLider(){
            try{
                $query = $this->conexion->prepare("CALL formLider();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar
        public function actualizarItem($pIdPersona2,$pGeneroLider2,$pTipoDocLider2,$pNomsLider2,$pApesLider2,$pCorreoLider2,$pUsuarioLider2,$pPiso,$pEstadoLider2){
            try{
                $query = $this->conexion->prepare("call actualizarLider($pIdPersona2,$pGeneroLider2,$pTipoDocLider2,'$pNomsLider2','$pApesLider2','$pCorreoLider2','$pUsuarioLider2',$pPiso,$pEstadoLider2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
        
        // Listar promedio de Líder DC
        public function listarPromedioLiderDC($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderDC('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder DP
        public function listarPromedioLiderDP($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderDP('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder IE
        public function listarPromedioLiderIE($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderIE('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder IB
        public function listarPromedioLiderIB($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderIB('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder NEG
        public function listarPromedioLiderNEG($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderNEG('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder MEN
        public function listarPromedioLiderMEN($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderMEN('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Líder IBF
        public function listarPromedioLiderIBF($mes){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioLiderIBF('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>




















