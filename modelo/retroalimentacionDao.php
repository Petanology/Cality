<?php

    require_once ("util/conexion.php");

    class retroalimentacionDao{ 

        private $conexion;
        private $tabla;

        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        // Validar Retroalimentacion
        // DC
        public function validacionRetroalimentacionDC($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionDC($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // DP
        public function validacionRetroalimentacionDP($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionDP($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // IE
        public function validacionRetroalimentacionIE($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIE($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IB
        public function validacionRetroalimentacionIB($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIB($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // NEG
        public function validacionRetroalimentacionNEG($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionNEG($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }


        // MEN 
        public function validacionRetroalimentacionMEN($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionMEN($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IBF 
        public function validacionRetroalimentacionIBF($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIBF($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // Listar Retroalimentaciones
        // DC
        public function listarRetroalimentacionDC($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionDC($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // DP
        public function listarRetroalimentacionDP($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionDP($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IE
        public function listarRetroalimentacionIE($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIE($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IB
        public function listarRetroalimentacionIB($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIB($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // NEG
        public function listarRetroalimentacionNEG($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionNEG($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // MEN
        public function listarRetroalimentacionMEN($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionMEN($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IBF
        public function listarRetroalimentacionIBF($ultimosDias,$minimo,$maximo,$idanalista){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIBF($ultimosDias,$minimo,$maximo,$idanalista);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        
    }
?>