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
    <!-- personalizados -->
    <link rel="stylesheet" href="css/acceso_denegado.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <title>Bienvenido a Cality</title>
</head>
<body>
<div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h1 class="display-4 d-block">¡Bienvenido, <?php $primerNombre = explode(" ",$_SESSION["nombres"]); echo $primerNombre[0];?>!</h1>
                    <div class="mb-4 lead">
                        Que bueno que estás de nuevo, Aprovehca al máximo todas las herramientas que te ofrece Cality: El sistema para la gestión de Calidad en llamadas de <strong>GF Cobranzas Jurídicas</strong>.
                    </div>
                    <a href="tipoDoc.php" class="btn btn-outline-primary "> ¡Empezar a Gestionar!</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>