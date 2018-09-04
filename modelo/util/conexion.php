<?php

    class Conexion {
        public static function getConexion(){
            $conn = null;
            try {
                $conn = new PDO("mysql:host=localhost:3307;dbname=mydb","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $ex){
                echo 'Nombre del error: '.$ex->getMessage();
            }
            return $conn;
        } 
    }


?>