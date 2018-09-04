<?php 
    if(isset($_GET['m'])){
        $mPositivo = "Felicidades, el registro / actualización fue un éxito";
        $mNegativo = "Lo sentimos, algo salió mal";
        $mensaje = $_GET["m"];
        
        if($mensaje == $mPositivo){
            echo "<div class='alert alert-primary fade show mt-3'>";
        }else {
            echo "<div class='alert alert-danger fade show mt-3'>";
        }    
            
        echo "$mensaje</div>";
    }
?>