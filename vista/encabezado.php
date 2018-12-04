<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Etiquetas Meta --> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carga_pagina.css">
    <link rel="stylesheet" href="css/gestionPointer.css">
    
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- Título -->
    <title>Manipulación de Registros | Cality</title>
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
    if(isset($_GET['m'])){
        $mNegativo = "Lo sentimos, algo salió mal... intente nuevamente por favor";
        $mensaje = $_GET["m"];
        
        if($mensaje == $mNegativo){
            echo "<div class='alert alert-danger fade show rounded-0'>";
        }else {
            echo "<div class='alert alert-primary fade show rounded-0'>";
        }    
            
        echo "$mensaje</div>";
        
        
        if($mensaje == $mNegativo){
            echo "<div class='ml-3'>";
            echo "<a class='badge badge-light p-2' href='javascript:history.back(1)'><i class='fas fa-angle-left'></i> Regresar al formulario</a>";
            echo "</div>";
        }
    }
?>