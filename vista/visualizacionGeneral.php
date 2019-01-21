<!-- importaciones requeridas -->
<?php 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    $piso = 0;
    if(isset($_SESSION['piso'])){
        $piso = $_SESSION['piso'];
    }    

    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    } else if($_SESSION["rol"]=="coord_financiera" || $_SESSION["rol"]=="coord_venta_directa" || $_SESSION["rol"]=="lider" ){
        header("location:acceso_denegado.php");
    }

    require_once ("../controlador/zonaHoraria.php");
    require_once ("../controlador/textoDeFecha.php");
    require_once ("../modelo/asesorDao.php");
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
        <link rel="stylesheet" href="css/visualizacionGeneral.css">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="img/faviconx32.png">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!-- Título -->
        <title>Reportes | Cality</title>
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
                    echo "<div class='alert alert-warning fade show rounded-0'>";
                }    

                echo "$mensaje</div>";


                if($mensaje == $mNegativo){
                    echo "<div class='ml-3'>";
                    echo "<a class='badge badge-light p-2' href='javascript:history.back(1)'><i class='fas fa-angle-left'></i> Regresar a intento</a>";
                    echo "</div>";
                }
            }
        ?>
    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="" class="bg-dark p-3 rounded" method="POST">
            <div class="form-group input-group-sm">
                <label for="mesConsulta" class="mb-3 w-100 h6 text-white text-center font-weight-bold">CONSULTAR GESTIONES</label>
                
                <label for="mes" style="color:#DDD;" class="pt-1 pb-1 font-weight-bold">Seleccionar mes</label>
                <input 
                    type="month" 
                    value="<?php echo date("Y"); ?>-<?php echo date("m"); ?>" 
                    name="mesConsulta" 
                    id="mesConsulta" 
                    class="input-sm mb-2 form-control"
                    required
                >
                
                <label for="tabla" style="color:#DDD;" class="pt-1 pb-1 font-weight-bold">Formato</label>
                <select name="tabla" id="tabla" class="input-sm mb-3 form-control" required>
                    <option value="" selected disabled>Seleccione un formato</option>
                    <option value="" disabled></option>
                    <optgroup label="Venta Directa"></optgroup>
                    <option value="dc">Negociación Comercial</option>
                    <option value="dp">Negociación Prejurídica</option>
                    <option value="ie">Mensaje</option>
                    <option value="ib">Inbound</option>
                    <option value="" disabled></option>
                    <optgroup label="Financiera"></optgroup>
                    <option value="neg">Negociación</option>
                    <option value="men">Mensaje</option>
                    <option value="ibf">Inbound</option>
                </select>
                
                <label for="asesorConsulta" style="color:#DDD;" class="pt-1 pb-1 font-weight-bold">Elegir asesor</label>
                <input 
                    list="asesor" 
                    class="pl-3 pt-3 pb-3 form-control form-control-sm" 
                    name="asesorConsulta" 
                    id="asesorConsulta" 
                    placeholder="Seleccione o digite el asesor que desea consultar"
                    title="cadena de texto entre 4 y 35 carácteres"
                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{4,35}"
                    required
                >
                <datalist id="asesor">
                    <?php
                        $objetoAsesorListaActivos = new asesorDao();
                        $resultadoListaAA = $objetoAsesorListaActivos->listarAsesoresActivos();
                        foreach ($resultadoListaAA as $rowAA){
                    ?>
                        <option value="<?php echo $rowAA[0]; ?>"><?php echo $rowAA[1]; ?></option>
                    <?php
                        }
                    ?>
                </datalist>
                
                <small style="color:#AAA;" class="form-text font-weight-bold mt-2 mb-2"><i class="far fa-question-circle"></i>&nbsp; por favor, seleccione un mes que contenga gestiones, además recuerde que solo puede consultar un asesor que se encuentre activo.</small>
            </div>
            <div class="form-group">
                <button type="submit" name="boton-consultar" class="btn btn-primary font-weight-bold btn-sm btn-block"><i class="fas fa-search"></i>&nbsp; BUSCAR GESTIONES</button>
            </div>
        </form>
        
        
        
        
        
        <!-- ------------------------- ----------------------------- -->
        
        <?php if(isset($_POST['boton-consultar'])){ 
              require_once ("modal/mEliminarGestion.php");
        ?>
            <!-- PRIMERA SECCION -->
            <?php 
                $mesConsulta = $_POST['mesConsulta'];
                $asesorConsulta = $_POST['asesorConsulta'];
                $tabla = $_POST['tabla'];
    
                $objetoAsesorDao = new asesorDao();
                $siHayGestiones = $objetoAsesorDao->saberConsultaGestionesUsuario($mesConsulta,$asesorConsulta,$tabla);
                $rc = null;
                foreach($siHayGestiones as $rowResultadoC){
                    $rc = $rowResultadoC;
                }
                if(isset($rc)){
                    
                $objetoAsesorDao2 = new asesorDao();
                $resultadoGestiones = $objetoAsesorDao2->verConsultaGestionesUsuario($mesConsulta,$asesorConsulta,$tabla);
                ?>    
                
                <p class="text-center text-secondary mt-4">Resultado(s) para la búsqueda</p>
                
                <?php    
                foreach($resultadoGestiones as $rowResultadoGestiones){
                ?>
                   
                <div class="contenedor-gestion">
                    <div class="iconos">
                        <button title="ver detalles de ésta gestión" class="btn btn-primary ml-1"><i class="far fa-eye"></i></button>
                        <?php if($rowResultadoGestiones[10] == $_SESSION['idpersona']){ ?>
                        <button title="modificar ésta gestión" class="btn btn-success ml-1"><i class="fas fa-pencil-alt"></i></button>
                        <?php } ?> 
                        <?php if($_SESSION["rol"]=="administrador"){ ?>
                        <button title="eliminar ésta gestión" class="btn btn-danger ml-1" onclick="botonEliminarGestion('<?php echo $rowResultadoGestiones[0]; ?>')"><i class="fas fa-trash-alt"></i></button>
                        <?php } ?> 
                    </div>
                    
                    <ul>
                        <li class="mb-2 font-weight-bold h6 text-primary"><?php echo $rowResultadoGestiones[0]; ?></li>
                        <li class="font-weight-bold"><?php echo $rowResultadoGestiones[4]; ?> - <?php echo $rowResultadoGestiones[3]; ?></li>
                        <li><strong>Asesor: </strong><?php echo $rowResultadoGestiones[1]; ?></li>
                        <li><strong>Analista de calidad: </strong><?php echo $rowResultadoGestiones[2]; ?></li>
                        <li><strong>Fecha: </strong><?php echo textoDeFecha($rowResultadoGestiones[6]); ?></li>
                        <li><strong>Error crítico: </strong><?php echo $rowResultadoGestiones[5]; ?></li>
                        <li>
                            <strong>Acumulado: </strong>
                            <?php if($rowResultadoGestiones[11] >= 0 && $rowResultadoGestiones[11] <= 68){ ?>
                                <span class="badge badge-danger"><?php echo $rowResultadoGestiones[11]; ?></span>
                            <?php } else 
                                  if($rowResultadoGestiones[11] >= 69 && $rowResultadoGestiones[11] <= 84){ ?>
                                <span class="badge badge-warning"><?php echo $rowResultadoGestiones[11]; ?></span>
                            <?php } else
                                  if($rowResultadoGestiones[11] >= 85 && $rowResultadoGestiones[11] <= 100){ ?> 
                                <span class="badge badge-success"><?php echo $rowResultadoGestiones[11]; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-info"><?php echo $rowResultadoGestiones[11]; ?></span>
                            <?php 
                                  }   
                            ?> 
                        </li>
                        <hr>
                        <li class="pb-2"><strong>Llamada: </strong></li>
                        <li><p class="p-2 rounded" style="background:#eee; border:1px solid #CCC;"><?php echo $rowResultadoGestiones[7]; ?></p></li>
                        
                        <li class="pb-2"><strong>Fortalezas: </strong></li>
                        <li><p class="p-2 rounded" style="background:#eee; border:1px solid #CCC;"><?php echo $rowResultadoGestiones[8]; ?></p></li>
                        
                        <li class="pb-2"><strong>Oportunidades: </strong></li>
                        <li><p class="p-2 rounded" style="background:#eee; border:1px solid #CCC;"><?php echo $rowResultadoGestiones[9]; ?></p></li>
                    </ul>
                </div>
            <?php 
                }
                }else{
            ?>
                <!-- SI NO HAY RESULTADOS -->
                <div class="container-fluid w-75 text-center">
                    <img src="img/busqueda-error.png" width="350" class="mt-2 mb-0" alt="icono de búsqueda">
                    <h2 class="h3 text-white mt-0">lo sentimos... <kbd class="h3">no</kbd> hay gestiones para el usuario ingresado</h2>
                </div>
            <?php    
                }
            ?>
        <?php } ?>
        
        <!-- ------------------------- ----------------------------- -->
    </div>
    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function botonEliminarGestion(ejemplo){
            $("#boton-eliminar").val(ejemplo);
            $('#form_eliminar_gestion').modal('show');
        }    
    </script>
</body> 
</html>




























