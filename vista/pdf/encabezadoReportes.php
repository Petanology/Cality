<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Etiquetas Meta --> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/carga_pagina.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../img/faviconx32.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- Título -->
    <title>Reportes | Cality</title>
</head>
<body class="scroll_modificado fondo-formulario">
    <!-- Contenedor loader -->
    <div class="contenedor-loader">   
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
    
    <?php
        
        
        if(isset($_GET['mensaje'])){
            $mensaje = $_GET['mensaje'];
            
            echo "<div class='alert alert-info fade show rounded-0'>$mensaje</div>";
        }
    
    ?>
 














