<?php
    // importaciones necesarias 
    require_once ("../controlador/sesiones.php");
    require_once ("../controlador/fecha.php");
    $sss = new sesiones();
    $sss->iniciar();
    /*
    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }*/
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
<body>
    <div>
        
        <!-- menu de navegación -->
        <nav id="menu" class="menu no-seleccionado">
            <!-- Icono menú -->
            <div class="icono-menu">
                <div class="primero"></div>
                <div class="segundo"></div>
                <div class="tercero"></div>
            </div>
            
            <!-- Contenedor -->
            <div class="contenido-menu">
                
                <!-- Links Principales -->
                <ul id="ul-menu" class="scroll_menu menu-tooltip"><!-- hay dos opciones que sea tooltip o normal -->
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
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/ayuda.png" alt="icono de ayuda">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Ayuda</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="http://192.168.10.70/Helpdesk/upload/open.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/tickets.png" alt="icono de ticket">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Sistema de tickets</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="manual/05manual_es.pdf" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/guide.png" alt="icono de manual">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Manual de ayuda</div>
                                   </a>
                               </li> 
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Perfiles -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/team.png" alt="icono de tablas">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Perfiles</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="administrador.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user.png" alt="icono de administrador">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Administrador</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="analista.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user.png" alt="icono de analista">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Analista</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="asesor.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user.png" alt="icono de asesor">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Asesor</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="lider.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user.png" alt="icono de líder">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Líder</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li>

                   
                    <!-- Gestión de datos complementarios -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/database.png" alt="icono de tablas">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Datos complementarios</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="errorCritico.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/error.png" alt="icono de error crítico">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Error crítico</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="genero.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/genero.png" alt="icono de genero">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Genero</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="tipoDoc.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/cedula.png" alt="icono de cédula">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Tipo de documento</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="tipoMonitoreo.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/tipoMonitoreo.png" alt="icono de tipo de monitoreo">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Tipo de monitoreo</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="unidad.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/unidad.png" alt="icono de unidad">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Unidad</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="valSecc.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/discount.png" alt="icono de valor de la sección">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Valor de la sección</div>
                                   </a>
                               </li>

                            </ul>
                        </div>
                    </li>
                    <!-- Gestiones de Calidad Venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/gestion-vd.png" alt="icono de gestión venta directa">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión - venta directa</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="gestionDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-vd-dc.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionDP.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-vd-dp.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo prejurídico</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIE.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-vd-ie.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto in-directo estándar</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIB.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-vd-ib.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound estándar</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Gestiones de Calidad Financiera -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/gestion-f.png" alt="icono de gestión financiera">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Gestión - financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="gestionNEG.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-f-todos.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionMEN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-f-todos.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIBF.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-f-todos.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li>
                    
                    
                    <!-- Retro - alimentación -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/writing.png" alt="icono de retro-alimentación">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Retroalimentación</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-vd.png" alt="icono de retroalimentación venta directa">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Venta directa</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-f.png" alt="icono de retroalimentación financiera">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Financiera</div>
                                   </a>
                               </li> 
                            </ul>
                        </div>
                    </li>
                    
                    <!-- divisor menu -->
                    <hr class="divisor-menu">
                    <h3 class="titulo-divisor-menu">general</h3>
                    
                    <!-- Informe venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/statistics.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Venta directa</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/indexReporteDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo prejurídico</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto in-directo estándar</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="pdf/indexReporteDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe sub listado">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound estándar</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>              
                    
                    <!-- Informe detallado -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/statistics.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li> 
                    
                    <!-- divisor menu -->
                    <hr class="divisor-menu">
                    <h3 class="titulo-divisor-menu">Detallado</h3>
                    
                    <!-- Informe venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/statistics.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Venta directa</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto directo prejurídico</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Contacto in-directo estándar</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="pdf/indexReporteDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe sub listado">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound estándar</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>              
                    
                    <!-- Informe detallado -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/statistics.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="acceso_denegado.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/statistics-sub.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>                    

                    
                    <!-- divisor menu -->
                    <hr class="divisor-menu">
                    <h3 class="titulo-divisor-menu">Mi sesión</h3>
                    
                    <li>
                        <a href="perfil.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/man.png" alt="icono de cerrar sesión">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Mi perfil</div>
                        </a>
                    </li>
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
                    <br><br><br>
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