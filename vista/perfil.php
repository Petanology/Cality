<?php
    // importaciones necesarias 
    require_once ("../controlador/sesiones.php");
    require_once ("../controlador/fecha.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }
?>
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
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- Título -->
    <title>Perfil | Cality</title>
</head>
<body class="scroll_modificado">
    <!-- Contenedor loader -->
    <div class="contenedor-loader">   
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
    <div class="container p-3">
        <div class="card">
            <div class="text-center">
                <img src="img/girl%20(1).png" width="100" height="100" class="rounded-circle border border-primary shadow-sm m-2" alt="Imagen de perfil">
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?php
                        echo "<strong>usuario: </strong>" . $_SESSION['usuario'];
                    ?>
                </li>
                <li class="list-group-item">
                    <?php
                        echo "<strong>identificación: </strong>" . $_SESSION['idpersona'];
                    ?>
                </li>
                <li class="list-group-item">
                    <?php
                        echo "<strong>nombres: </strong>" . $_SESSION['nombres'];
                    ?>
                </li>
                <li class="list-group-item">
                    <?php
                        echo "<strong>genero: </strong>" . $_SESSION['genero'];
                    ?>
                </li>
                <li class="list-group-item">
                    <?php
                        echo "<strong>correo electronico: </strong>" . $_SESSION['correo'];
                    ?>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>    
    
    
    