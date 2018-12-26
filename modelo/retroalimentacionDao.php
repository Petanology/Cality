<?php

    require_once ("util/conexion.php");

    class retroalimentacionDao{ 

    private $conexion;
    private $tabla;

    public function __construct(){
        $objetoConexion = new Conexion();
        $this->conexion = $objetoConexion->conn;
    }
        
        
    public function validacionRetroalimentacion($tabla,$ultimosDias,$puntaje){
        try{
            $query = $this->conexion->prepare("CALL validacionRetroalimentacion('$tabla',$ultimosDias,$puntaje);");
            $query->execute();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        return $query;
    }
        
        
    public function listarRetroalimentacion($tabla,$ultimosDias,$puntaje){
        try{
            $query = $this->conexion->prepare("CALL listarRetroalimentacion('$tabla',$ultimosDias,$puntaje);");
            $query->execute();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        return $query;
    }
    }
?>