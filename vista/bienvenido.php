<?php
    // importaciones requeridas
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Etiquetas meta -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!-- Estilos -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bienvenido.css">
        <!-- personalizados -->
        <link rel="stylesheet" href="css/acceso_denegado.css">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
        <link rel="stylesheet" href="css/carga_pagina.css">


        <!-- Font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <title>Bienvenido a Cality</title>
    </head>
    <body>
    
    <!-- Contenedor loader -->
    <div class="contenedor-loader">   
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>

    <?php
        function primerNombre(){    
            $primerNombre = explode(" ",$_SESSION["nombres"]); 
            echo $primerNombre[0];
        }


        function contextoGenero(){
            if($_SESSION["genero"] == "Masculino"){ 
                echo "o";
            }
            else if($_SESSION["genero"] == "Femenino"){
                echo "a";
            }
            else{
                echo "@";
            }
        } 
    ?>


    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center text-white">
                    <h1 class="texto1 display-4 d-block">¡Bienvenid<?php contextoGenero();  ?>, <?php primerNombre(); ?>!</h1>
                    <div class="mb-4 lead texto2">
                        Que bueno que estás de nuevo, aprovecha al máximo todas las herramientas que te ofrece Cality: El sistema para la gestión de Calidad en llamadas de <strong>GF Cobranzas Jurídicas</strong>.
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bienvenido.js"></script>
</body>
</html>