<?php
    require_once ("util/conexion.php");

    class gestionGeneralDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        private $tabla;
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarCalificacion($tablaRegistro,$campoRegistro,$idGestion,$pItem,$pAprobado){
            try{
                $query = $this->conexion->prepare("CALL registrarCalificacion('$tablaRegistro','$campoRegistro','$idGestion',$pItem,$pAprobado);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        // DC
        public function validacionParaInformeDC($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeDC('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // DP
        public function validacionParaInformeDP($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeDP('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IE
        public function validacionParaInformeIE($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeIE('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IB
        public function validacionParaInformeIB($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeIB('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // NEG
        public function validacionParaInformeNEG($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeNEG('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // MEN
        public function validacionParaInformeMEN($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeMEN('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IBF
        public function validacionParaInformeIBF($mes){
            try{
                $query = $this->conexion->prepare("CALL validacionParaInformeIBF('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // validacion para informe detallado MENSAJE
        public function validacionDetalladoMEN($asesorId,$mes){
            try{
                $query = $this->conexion->prepare("CALL validacionDetalladoMEN('$asesorId','$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>