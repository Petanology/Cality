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
        public function validacionRetroalimentacionDC($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionDC($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // DP
        public function validacionRetroalimentacionDP($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionDP($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // IE
        public function validacionRetroalimentacionIE($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIE($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IB
        public function validacionRetroalimentacionIB($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIB($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // NEG
        public function validacionRetroalimentacionNEG($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionNEG($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }


        // MEN 
        public function validacionRetroalimentacionMEN($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionMEN($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IBF 
        public function validacionRetroalimentacionIBF($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL validacionRetroalimentacionIBF($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // Listar Retroalimentaciones
        // DC
        public function listarRetroalimentacionDC($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionDC($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // DP
        public function listarRetroalimentacionDP($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionDP($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IE
        public function listarRetroalimentacionIE($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIE($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IB
        public function listarRetroalimentacionIB($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIB($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // NEG
        public function listarRetroalimentacionNEG($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionNEG($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // MEN
        public function listarRetroalimentacionMEN($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionMEN($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // IBF
        public function listarRetroalimentacionIBF($ultimosDias,$puntaje){
            try{
                $query = $this->conexion->prepare("CALL listarRetroalimentacionIBF($ultimosDias,$puntaje);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        
    }
?>