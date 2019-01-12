<?php

    class Conexion {
        
        public $conn = null;
        
        public function __construct(){
            try {
                $this->conn = new PDO("mysql:host=localhost;dbname=cality", "root", "GFc/2015*.*",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $ex){
                echo 'Nombre del error: '.$ex->getMessage();
            }

            return $this->conn;
        }
    }
?>