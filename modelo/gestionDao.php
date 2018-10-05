<?php
    require_once ("util/conexion.php");

    class gestionDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        private $tabla;
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarEncabezado($idGestion,$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,$fecha,$valor1,$valor2,$valor3,$observacion){
            try{
                $query = $this->conexion->prepare("CALL registrarEncabezado('$idGestion',$tipoMonitoreo,$errorCritico,$unidad,$asesor,$analista,'$fecha',$valor1,$valor2,$valor3,'$observacion');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        
        public function registrarDCS($idGestion,$pItem,$pAprobado){
            try{
                $query = $this->conexion->prepare("CALL registrarDCS('$idGestion',$pItem,$pAprobado);");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false;
            }
            return $this->registro;
        }
        
        public function actualizarItem($pId2,$pTitulo2,$pDescripcion2,$pEstado2){
            try{
                $query = $this->conexion->prepare("call actualizarItems('$this->tabla',$pId2,'$pTitulo2','$pDescripcion2',$pEstado2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }
        
        
        // Listar Tabla
        public function listarTabla(){
            try{
                $query = $this->conexion->prepare("CALL listarTablaItems('$this->tabla');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemItems('$this->tabla',$pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarItemsActivos(){
            try{
                $query = $this->conexion->prepare("call listarItemsActivos('$this->tabla')"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    }
?>