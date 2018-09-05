<?php
    // importaciones necesarias 
    require_once ("../controlador/sesiones.php");
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
    <link rel="stylesheet" href="css/inicio.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <title>Página de inicio | Cality</title>
</head>
<body>
    
    <div class="main">
        <!-- menu de navegación -->
        <nav class="menu">
            <!-- Menu -->
            <?php
                echo $_SESSION['usuario'] . " | ";
                echo $_SESSION['idpersona'] . " | ";
                echo $_SESSION['nombres'] . " | ";
                echo $_SESSION['genero'] . " | ";
                echo $_SESSION['correo'] . " | ";
                echo $_SESSION['rol'];
            ?>
            <div class="icono-menu">
                <div class="primero">-</div>
                <div class="segundo">-</div>
                <div class="tercero">-</div>
            </div>
            
            <!-- Links Principales -->
            <ul>
                <li><a href="#">inicio</a></li>
                <li><a href="#">registros</a></li>
                <li><a href="#">reportes</a></li>
                <li><a href="tipoDoc.php" class="btn btn-primary">Tipo Documento</a></li>
                <li><a href="#">ayuda</a></li>
                <li><a href="#">gestión</a></li>
            </ul>
            
            <!-- Links Perfil -->
            <ul>
                <li><a href="../controlador/logoutControlador.php">Cerrar sesión</a></li>
            </ul> 
        </nav>
        
        <div class="encabezado">
            <div class="calendario">
                <img src="" alt="">
            </div>
        </div>
        
        <div class="contenido-principal">
            <iframe class="iframe" src="tipoDoc.php"></iframe>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>