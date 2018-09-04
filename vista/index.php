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
    <link rel="stylesheet" href="css/index.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- Titulo -->
    <title>Iniciar Sesión | Cality</title>
</head>
<body>
    <header>
        <nav>
        </nav>
    </header>
    
    <div class="main">
        <div class="contenedor-1">
            
        </div>
        
        <div class="contenedor-2">
            <form action="../controlador/loginControlador.php" method="post" required>
            
                <h1>Login</h1>

                <!-- Rol -->
                <label for="rol">Rol Correspondiente</label>
                <select name="rol" id="rol" required>
                <option value="">Seleccione su rol</option>
                <option value="administrador" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="administrador"){echo "selected";} ?>>Administrador</option>
                <option value="analista" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="analista"){echo "selected";} ?>>Analista</option>
                <option value="lider" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="lider"){echo "selected";} ?>>Líder</option>
                <option value="asesor" <?php if(!empty($_GET['rol']) AND $_GET['rol']=="asesor"){echo "selected";} ?>>Asesor</option>
                </select>

                <!-- usuario -->
                <label for="usuario">Usuario</label>
                <input <?php
                if(!empty($_GET['usu'])){
                echo "value='".$_GET['usu']."'"; 
                }                           
                ?> type="text" name="usuario" class="text" id="usuario" placeholder="Digite su nombre de usuario" required>

                <!-- contraseña -->
                <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="text" name="contrasena" id="contrasena" placeholder="Digite su contraseña" required>
                </div>

                <!-- submit -->
                <input type="submit" value="INICIAR SESIÓN" class="boton">
            </form>    
        </div>
    </div>
       
        <?php
            if(!empty($_GET['m'])){
                echo "<p class='alert alert-danger alert-dimissible fade show'> ". $_GET['m'] . 
                        "<span aria-hidden='true' class='close' data-dismiss='alert' aria-label='Colse'>&times;</span>
                      </p>";
            }
        ?>

</body>
</html>