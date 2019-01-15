<?php

    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    
    if(!empty($_SESSION['autenticado'])){
         header("location: inicio.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Etiquetas meta --> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/carga_pagina.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/index.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> -->
    
    <!-- Titulo -->
    <title>Iniciar Sesión | Cality</title> 
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
    
    <!-- Formas -->
    
    
    <div class="main">
       
        <div class="formas">
            <div class="fig-2"></div>
            <div class="fig-1"></div>
        </div>  
              
        <!-- Figura 1 -->
        <div class="contenedor-1">
            <img src="img/faviconx512-2.png" alt="favicon de Cality">
            <p>¡Bienvenido al aplicativo <strong>Cality</strong>! <span class="parrafo-extendido">Una plataforma web para la gestión de calidad en llamadas de GF Cobranzas</span></p>
        </div>
        
        <div class="contenedor-2">
            <div class="imagen-encabezado">
                <img src="img/candado.png" alt="Icono candado">
            </div>
           
            <form action="../controlador/loginControlador.php" method="post" required>
            
                <div class="presentacion-opcional"><img src="img/faviconx30-2.png" alt="icono principal cality"><p>¡Bienvenido a Cality!</p></div>
                <h1>Login</h1>
                
                <!-- Rol -->
                <label for="rol">Rol Correspondiente</label>
                <select name="rol" id="rol" required>
                    <option value="" disabled>Seleccion1e su rol</option>
                    <option value="analista" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="analista"){echo "selected";} ?>>Analista</option>
                    <option value="lider" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="lider"){echo "selected";} ?>>Líder</option>
                    <option value="administrador" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="administrador"){echo "selected";} ?>>Administrador</option>
                    <option value="jefe_operaciones" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="jefe_operaciones"){echo "selected";} ?>>Jefe de operaciones</option>
                    <option value="coord_venta_directa" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="coord_venta_directa"){echo "selected";} ?>>Coordinador Venta Directa</option>
                    <option value="coord_financiera" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="coord_financiera"){echo "selected";} ?>>Coordinador Financiera</option>
                </select>

                <!-- usuario -->
                <label for="usuario">Usuario</label>
                <input <?php
                if(!empty($_GET['usu'])){
                echo "value='".$_GET['usu']."'"; 
                }                           
                ?> type="text" name="usuario" class="text" id="usuario" placeholder="Digite su nombre de usuario" required>

                <!-- contraseña -->
                <div class="contenedor-contrasena">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="password" class="text" name="contrasena" id="contrasena" placeholder="Digite su contraseña" required>
                    <div class="ojo cerrar" title="Mostrar contraseña"></div>
                </div>

                <!-- submit -->
                <button type="submit" class="boton">INICIAR SESIÓN</button>
                <a href="#" class="link">¿Olvidó su contraseña?</a>
            </form>    
        </div>
    </div>
       
        <?php
            if(!empty($_GET['m'])){
                echo "
                    <div class='alerta'>
                    <p>".$_GET['m']."</p>
                    <span class='cerrar-alerta'>&times;</span>
                    </div>
                    ";
            }
        ?>
        
    <!-- scripts -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/index.js"></script>    
</body>
</html>