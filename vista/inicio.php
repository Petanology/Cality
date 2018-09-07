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
    <!-- Etiquetas meta --> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/ondas.css">
    <link rel="stylesheet" href="css/inicio.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <title>Página de inicio | Cality</title>
    
    <!-- Jquery con ondas -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Ondas -->
    <script src="js/wave.js"></script>
</head>
<body>
    
    <div class="main scroll_modificado">
        <!-- menu de navegación -->
        <nav class="menu">
            <!-- Icono menú -->
            <div class="icono-menu">
                <div class="primero"></div>
                <div class="segundo"></div>
                <div class="tercero"></div>
            </div>
            
            <!-- Contenedor -->
            <div class="contenido-menu">
                <?php
                    /*echo $_SESSION['usuario'] . " | ";
                    echo $_SESSION['idpersona'] . " | ";
                    echo $_SESSION['nombres'] . " | ";
                    echo $_SESSION['genero'] . " | ";
                    echo $_SESSION['correo'] . " | ";*/
                ?>
                
                <!-- Links Principales -->
                <ul>
                    <li><a href="#">inicio</a></li>
                    <!--
                    <li><a href="#">registros</a></li>
                    <li><a href="#">reportes</a></li>
                    <li><a href="tipoDoc.php" class="btn btn-primary">Tipo Documento</a></li>
                    <li><a href="#">ayuda</a></li>
                    <li><a href="#">gestión</a></li>-->
                </ul>

                <!-- Links Perfil -->
                <ul>
                    <li><a href="../controlador/logoutControlador.php">Cerrar sesión</a></li>
                </ul> 
            </div>
        </nav>
        
        <div class="contenedor-derecha">
            <div class="encabezado">    
                <!-- Calendario y fecha -->        
                <div class="calendario">
                    <img src="img/wall-calendar.png" alt="Icono calendario">
                    <span class="fecha"><?php $fecha = new fecha(); echo $fecha->traerFecha() ?></span>
                </div>
                
                <!-- logotipo -->
                <div class="logotipo">
                    <h1>CALITY<span><?php echo $_SESSION['rol']; ?></span></h1>
                    <img src="img/faviconx512-3.png" alt="Icono de cality">
                </div>
            </div>
            

            <div class="contenido-principal">
                <iframe class="iframe" src="tipoDoc.php"></iframe>
            </div>
        </div>
    </div>
    
    <!-- Jquery -->
    <script src="js/inicio.js"></script>
</body>
</html>