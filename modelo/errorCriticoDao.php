<?php
    require_once ("util/conexion.php");

    class errorCriticoDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrar($pRegistrar){
            try{
                $query = $this->conexion->prepare("CALL registrarErrorCritico('$pRegistrar');");
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
                $query = $this->conexion->prepare("CALL listarTablaErrorCritico();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar item error critico
        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemErrorCritico($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        // listar errores criticos activos
        public function listarErroresCriticosActivos(){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosActivos()"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Actualizar error Critico
        public function actualizarItem($pId,$pNombre,$pEstado){
            try{
                $query = $this->conexion->prepare("call actualizarErrorCritico($pId,'$pNombre',$pEstado)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
        

        // listar errores criticos total DC
        public function listarErroresCriticosDC($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosDC('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // listar errores criticos total DP
        public function listarErroresCriticosDP($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosDP('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos total IE
        public function listarErroresCriticosIE($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosIE('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos total IB
        public function listarErroresCriticosIB($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosIB('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos total NEG
        public function listarErroresCriticosNEG($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosNEG('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        // listar errores criticos total MEN
        public function listarErroresCriticosMEN($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosMEN('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos total IBF
        public function listarErroresCriticosIBF($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosIBF('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }



        // listar errores criticos infringidos por ciertas personas DC
        public function listarErroresCriticosInfringidosDC($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosDC('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        // listar errores criticos infringidos por ciertas personas DP
        public function listarErroresCriticosInfringidosDP($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosDP('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos infringidos por ciertas personas IE
        public function listarErroresCriticosInfringidosIE($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosIE('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // listar errores criticos infringidos por ciertas personas IB
        public function listarErroresCriticosInfringidosIB($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosIB('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos infringidos por ciertas personas NEG
        public function listarErroresCriticosInfringidosNEG($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosNEG('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // listar errores criticos infringidos por ciertas personas MEN
        public function listarErroresCriticosInfringidosMEN($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosMEN('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // listar errores criticos infringidos por ciertas personas IBF
        public function listarErroresCriticosInfringidosIBF($mes){
            try{
                $query = $this->conexion->prepare("call listarErroresCriticosInfringidosIBF('$mes%')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    }
?>