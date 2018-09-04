<?php
    class sesiones{
        // constructor vacío
        public function __construct(){
            
        }
        
        // metodo habilitar manejo de sesiones
        public function iniciar(){
            @session_start(); // arroba para ignorar errores
        }
        
        
        public function set($varnombre, $valor){
            $_SESSION[$varnombre] = $valor;
        }
        
        public function destruir(){
            session_unset();
            session_destroy(); // por si las moscas :v
        }
        
    }
?>