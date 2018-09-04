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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <title>Página de inicio | Cality</title>
</head>
<body>
    <?php
        echo $_SESSION['usuario'] . " | ";
        echo $_SESSION['idpersona'] . " | ";
        echo $_SESSION['nombres'] . " | ";
        echo $_SESSION['genero'] . " | ";
        echo $_SESSION['correo'] . " | ";
        echo $_SESSION['rol'];
    ?>
    
    <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quisquam quas amet itaque voluptates. Ut architecto maiores est dicta laborum nam repellendus sed eaque, recusandae, quisquam, voluptate impedit cupiditate explicabo debitis exercitationem dolore magni consectetur molestias rerum labore cumque odit. Laboriosam, ab nostrum vero eveniet dicta, aspernatur quod, itaque distinctio numquam culpa voluptates quas ipsum excepturi mollitia. Nihil totam, quasi necessitatibus repudiandae, nemo nostrum corrupti vero veritatis consectetur accusamus eveniet quod fugit molestiae odit sunt reprehenderit omnis voluptate incidunt, ullam sint suscipit numquam ratione nam? Reprehenderit quae, obcaecati aspernatur rerum odit dolorum nostrum eveniet veritatis recusandae adipisci ratione quis corporis!

            <div class="embed-responsive">
                <iframe class="embed-responsive-item" src="tipoDoc.php"></iframe>
            </div>
        </div>
    </div>

    <a href="../controlador/logoutControlador.php">Cerrar sesión</a>
    
    <a href="tipoDoc.php" class="btn btn-primary">Tipo Documento</a>
    
    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>