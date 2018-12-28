<?php
    require_once ("util/conexion.php");

    class encabezadoDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        public function registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$llamada,$fortalezas,$oportunidades){
            try{
                $query = $this->conexion->prepare("CALL registrarEncabezado('$idGestion',$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,'$fecha','$llamada','$fortalezas','$oportunidades');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarValorSeccionEncabezado($idGestion,$pNumeroGrupo,$pValor){
            try{
                $query = $this->conexion->prepare("CALL registrarValorSeccionEncabezado('$idGestion',$pNumeroGrupo,$pValor);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarPromedio_dc($idGestion,$valorG1,$valorG2,$valorG3,$valorG4){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_dc('$idGestion',$valorG1,$valorG2,$valorG3,$valorG4);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
                
        public function registrarPromedio_dp($idGestion,$valorG1,$valorG2,$valorG3,$valorG4){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_dp('$idGestion',$valorG1,$valorG2,$valorG3,$valorG4);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        

        public function registrarPromedio_ie($idGestion,$valorG1,$valorG2,$valorG3){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_ie('$idGestion',$valorG1,$valorG2,$valorG3);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarPromedio_ib($idGestion,$valorG1,$valorG2,$valorG3){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_ib('$idGestion',$valorG1,$valorG2,$valorG3);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarPromedio_neg($idGestion,$valorG1,$valorG2,$valorG3,$valorG4,$valorG5){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_neg('$idGestion',$valorG1,$valorG2,$valorG3,$valorG4,$valorG5);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarPromedio_men($idGestion,$valorG1,$valorG2,$valorG3){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_men('$idGestion',$valorG1,$valorG2,$valorG3);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarPromedio_ibf($idGestion,$valorG1,$valorG2,$valorG3){
            try{
                $query = $this->conexion->prepare("CALL registrarPromedio_ibf('$idGestion',$valorG1,$valorG2,$valorG3);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
    }
?>