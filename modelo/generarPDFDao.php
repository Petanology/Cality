<?php
    require_once ("util/conexion.php");

    class generarPDFDao{ 
        
        
        private $conexion;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        public function listarPrimerValorGrupoDC($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoDC('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoDP($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoDP('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIE($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIE('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIB($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIB('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarPrimerValorGrupoNEG($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoNEG('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoMEN($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoMEN('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIBF($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIBF('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIBF($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIBF('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoMENSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        public function listarNotaDetalladoMENIT($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENIT('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoMENRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }


    }
?>