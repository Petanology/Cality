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
        
        public function registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$observacion){
            try{
                $query = $this->conexion->prepare("CALL registrarEncabezado('$idGestion',$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,'$fecha','$observacion');");
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
    }
?>