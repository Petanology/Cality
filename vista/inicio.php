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
    <link rel="stylesheet" href="css/inicio.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">
    
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <title>Página de inicio | Cality</title>
    
    <!-- Jquery con ondas -->
    <script src="js/jquery-3.3.1.min.js"></script>
    
    <!--<script src="js/wave.js"></script>-->
</head>
<body class="scroll_modificado">
   
    <div class="main scroll_modificado">
        
        <!-- menu de navegación -->
        <nav id="menu" class="menu">
            <!-- Icono menú -->
            <div class="icono-menu">
                <div class="primero"></div>
                <div class="segundo"></div>
                <div class="tercero"></div>
            </div>
            
            <!-- Contenedor -->
            <div class="contenido-menu scroll_menu">
                
                <!-- Links Principales -->
                <ul id="ul-menu" class="menu-tooltip scroll_modificado"><!-- hay dos opciones que sea tooltip o normal -->
                    <!-- Link Inicio -->
                    <li>
                        <a href="bienvenido.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/incio.png" alt="icono de inicio">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Inicio</div>
                        </a>
                    </li>
                    
                    <!-- Link Ayuda -->
                    <li>
                        <a href="http://192.168.10.70/Helpdesk/upload/open.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/ayuda.png" alt="icono de ayuda">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Ayuda</div>
                        </a>
                    </li>
                    
                    <!-- Base de Datos -->
                    <li>
                        <a href="links.html" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/documento.png" alt="icono de tablas">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión de Tablas</div>
                        </a>
                    </li>
                    
                    <!-- Informes -->
                    <li>
                        <a href="acceso_denegado.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/estadistica.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Informes</div>
                        </a>
                    </li>
                    
                    <hr class="divisor-menu">
                    
                    <!-- Gestion de Calidad -->
                    <li>
                        <a href="gestionDC.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/directo-comercial.png" alt="icono de gestión de calidad">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión Directa Comercial</div>
                        </a>
                    </li>
                    
                    <!-- Gestion de Calidad -->
                    <li>
                        <a href="gestionDP.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/directo-prejuridica.png" alt="icono de gestión de calidad">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión Directa Prejurídica</div>
                        </a>
                    </li>
            
                    <!-- Gestion de Calidad -->
                    <li>
                        <a href="gestionIE.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/indirecto-estandar.png" alt="icono de gestión de calidad">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión In-directa Estándar</div>
                        </a>
                    </li>
                    
                    <!-- Gestion de Calidad -->
                    <li>
                        <a href="gestionIB.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/in-bound.png" alt="icono de gestión de calidad">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión In-Bound</div>
                        </a>
                    </li>
                    
                    <hr class="divisor-menu">
                    
                    <li>
                        <a href="../controlador/logoutControlador.php">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/cerrar-sesion.png" alt="icono de cerrar sesión">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Cerrar Sesión</div>
                        </a>
                    </li>
                    <!--
                    <li><a href="#">registros</a></li>
                    <li><a href="#">reportes</a></li>
                    <li><a href="tipoDoc.php" class="btn btn-primary">Tipo Documento</a></li>
                    <li><a href="#">ayuda</a></li>
                    <li><a href="#">gestión</a></li>-->
                </ul>
                
                <!--
                <li class="cerrar-sesion"><a href="../controlador/logoutControlador.php">Salir</a></li>
                -->
                
                <ul class="menu-sesion">
                    <li class="mi-cuenta">Mi cuenta</li>
                    <li class="img-perfil"><img src="img/girl%20(2).png" alt="Icono foto de perfil"></li>
                </ul>
            </div>
        </nav>
        
        <div id="fondo-toggle" class="fondo-toggle"></div>
        
        <div id="contenedor-derecha" class="contenedor-derecha">
            <div class="encabezado">    
                <!-- Calendario y fecha -->        
                <div class="calendario">
                    <img src="img/calendario.png" alt="Icono calendario">
                    <span class="fecha"><?php $fecha = new fecha(); echo $fecha->traerFecha() ?></span>
                </div>
                
                <!-- logotipo -->
                <div class="logotipo">
                    <h1>CALITY<span><?php echo $_SESSION['rol']; ?></span></h1>
                    <img src="img/faviconx512-3.png" alt="Icono de cality">
                </div>
            </div>
            

            <div class="contenido-principal">
                <iframe name="contenido" class="iframe" src="bienvenido.php"></iframe>
            </div>
        </div>
    </div>
    
    <!-- Jquery -->
    <script src="js/inicio.js"></script>
</body>
</html>