<?php
    // importaciones necesarias 
    require_once ("../controlador/sesiones.php");
    require_once ("../controlador/zonaHoraria.php");
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
                                       <div class="texto">Ticket de soporte</div>
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
                    <?php
                    if($_SESSION['rol']=="administrador" || $_SESSION['rol']=="analista"){
                    ?>                    
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
                            <?php
                            if($_SESSION['rol']=="administrador"){
                            ?>
                               <li>
                                   <a href="administrador.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user-administrador.png" alt="icono de administrador">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Administrador</div>
                                   </a>
                               </li>
                            <?php
                            }
                            ?>
                               <li>
                                   <a href="analista.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user-analista.png" alt="icono de analista">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Analista</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="asesor.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user-asesor.png" alt="icono de asesor">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Asesor</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="lider.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/user-lider.png" alt="icono de líder">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Líder</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    
                    
                    <?php
                    if($_SESSION['rol']=="administrador" || $_SESSION['rol']=="analista"){
                    ?>
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
                    <?php
                    }
                    ?>
                    
                    <!-- Visualización -->
                    
                    <?php
                    if($_SESSION['rol']=="analista"){
                    ?>
                    <li>
                        <a href="acceso_denegado.php" target="contenido">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/ojo.png" alt="icono de visualizacion">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Visualizar Gestión</div>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    
                    
                    <?php
                    if($_SESSION['rol']=="analista"){
                    ?>
                    <!-- divisor menu -->
                    <h3 class="titulo-divisor-menu">Gestión de calidad</h3>
                    
                    <!-- Gestiones de Calidad Venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/gestion-vd.png" alt="icono de gestión venta directa">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Venta directa</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="gestionDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-dc.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionDP.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-dp.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación prejurídica</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIE.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-ie.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIB.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-ib.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
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
                            <div class="texto">Financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="gestionNEG.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-financiera.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionMEN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-financiera.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="gestionIBF.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/gestion-financiera.png" alt="icono de gestión">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li> 
                    <?php
                    }
                    ?>
                    
                    
                    <?php
                    if($_SESSION['rol']=="administrador" || $_SESSION['rol']=="analista" || $_SESSION['rol']=="lider"){
                    ?>
                    <!-- divisor menu -->
                    <h3 class="titulo-divisor-menu">informe general</h3>
                    
                    <!-- Informe venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/informe-vd.png" alt="icono de informe">
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
                                           <img src="img/i-general-dc.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexReporteDP.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-dp.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación prejurídica</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexReporteIE.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-ie.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="pdf/indexReporteIB.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-ib.png" alt="icono de informe sub listado">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>              
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/informe-f.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/indexReporteNEG.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexReporteMEN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexPromedioIBF.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/i-general-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li> 
                    
                    <!-- informe detallado -->
                    <!-- divisor menu -->
                    <h3 class="titulo-divisor-menu">informe Detallado</h3>
                    
                    <!-- Informe venta directa -->
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/detallado-vd.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Venta directa</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/indexDetalladoDC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-dc.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación comercial</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexDetalladoDP.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-dp.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación prejurídica</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexDetalladoIE.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-ie.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="pdf/indexDetalladoIB" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-ib.png" alt="icono de informe sub listado">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>              
                    
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/detallado-f.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Financiera</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="pdf/indexDetalladoNEG.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexDetalladoMEN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Mensaje</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="pdf/indexDetalladoIBF.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/detallado-financiera.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Inbound</div>
                                   </a>
                               </li>                           
                            </ul>
                        </div>
                    </li>
                    <?php
                    }
                    ?> 

                    <?php
                    if($_SESSION["rol"] == "analista"){
                    ?>
                    <!-- divisor menu -->
                    <h3 class="mega-titulo-divisor-menu">Items</h3>       
                    <h3 class="titulo-divisor-menu">Venta directa</h3>       
                    
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_dc" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Negociación comercial</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemDCS.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dc_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemDCN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dc_neg.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemDCC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dc_cc.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Cierre de compromiso</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="itemDCR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dc_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_dp.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Negociación prejurídica</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemDPS.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dp_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemDPN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dp_neg.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación I</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemDPN2.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dp_neg2.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación II</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="itemDPR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_dp_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_ie.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Mensaje</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemIES.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ie_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemIEI.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ie_it.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Información a terceros</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemIER.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ie_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_ib.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Inbound</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemIBS.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ib_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemIBO.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ib_oll.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Objeto de la llamada</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemIBR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ib_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>  
                            </ul>
                        </div>
                    </li>

                    <!-- financiera --> 
                    <h3 class="titulo-divisor-menu">Financiera</h3>       
                    
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_financiera.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Negociación</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemNPEP.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_neg_pep.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Protocolo y etiqueta profesional</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemNSC.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_neg_sc.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio al cliente</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemNN.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_neg_n.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Negociación</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemNA.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_neg_ad.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Actualización de datos</div>
                                   </a>
                               </li>
                               <li>
                                   <a href="itemNR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_neg_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_financiera.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Mensaje</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemMS.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_men_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemMI.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_men_it.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Información a terceros</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemMR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_men_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <!-- Icono -->
                            <div class="cont-img">
                                <img src="img/item_financiera.png" alt="icono de informe">
                            </div>
                            
                            <!-- Texto -->
                            <div class="texto">Inbound</div>
                        </a>
                        <div class="submenu-item">
                            <ul>
                               <li>
                                   <a href="itemIBFS.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ibf_set.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Servicio y etiqueta telefónica</div>
                                   </a>
                               </li>       
                               <li>
                                   <a href="itemIBFO.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ibf_oll.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Objeto de la llamada</div>
                                   </a>
                               </li> 
                               <li>
                                   <a href="itemIBFR.php" target="contenido">
                                       <!-- Icono -->
                                       <div class="cont-img">
                                           <img src="img/item_ibf_rs.png" alt="icono de informe">
                                       </div>
                                       <!-- Texto -->
                                       <div class="texto">Registro en el sistema</div>
                                   </a>
                               </li>  
                            </ul>
                        </div>
                    </li>
                    <?php    
                    }
                    ?>
                                       

                    
                    <!-- divisor menu -->
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
                    <br><br><br><br><br>
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