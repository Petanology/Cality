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
    } else if($_SESSION["rol"]=="coord_financiera"){
        header("location:acceso_denegado.php");
    } else if($piso == 3){
        header("location:acceso_denegado.php");
    }

    require_once ("../controlador/zonaHoraria.php");
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


            if(isset($_GET['mensaje'])){
                $mensaje = $_GET['mensaje'];

                echo "<div class='alert alert-info fade show rounded-0'>$mensaje</div>";
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
                
                <small style="color:#AAA;" class="form-text font-weight-bold mt-2 mb-2"><i class="far fa-question-circle"></i>&nbsp; por favor, seleccione un mes que contenga gestiones, además recuerde que solo puede consultar un asesor que se encuentre activo.</small>
            </div>
            <div class="form-group">
                <button type="submit" name="boton-consultar" class="btn btn-primary font-weight-bold btn-sm btn-block"><i class="fas fa-search"></i>&nbsp; BUSCAR GESTIONES</button>
            </div>
        </form>
        
        
        
        
        
        <!-- ------------------------- ----------------------------- -->
        
        <?php if(isset($_POST['boton-consultar'])){ ?>
            <!-- PRIMERA SECCION -->
            <?php 
                $mesConsulta = $_POST['mesConsulta'];
                $asesorConsulta = $_POST['asesorConsulta'];
                $tabla = $_POST['tabla'];
    
                $objetoAsesorDao = new asesorDao();
                $siHayGestiones = $objetoAsesorDao->saberGestionesUsuario($mesConsulta,$asesorConsulta,$tabla);
                $rc = null;
                foreach($siHayGestiones as $rowResultadoC){
                    $rc = $rowResultadoC;
                }
                if(isset($rc)){
            ?>
                <div class="rounded shadow-lg bg-white">
                <form name="formGeneral" action="../controlador/gestionDCControlador.php" method="post" autocomplete="off">
                <p class="rounded-top font-weight-bold pt-3 text-white p-3" style="background-color:#0f6ecc;">Area de Calidad - Formato Calidad Etapas Comerciales Venta Directa</p>
                <div class="container pb-2">
                    <?php
                        $asesorConsulta = $_POST['asesorConsulta'];
                        $objetoAD = new asesorDao();
                        $resultadoAG = $objetoAD->listarAsesorGestion($asesorConsulta);
                        foreach($resultadoAG as $rowIA){
                    ?>
                    <p class="font-weight-bold text-center mb-0">INFORMACIÓN GENERAL</p>
                    <hr class="m-2">                    
                    <!-- Usuario --> 
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Usuario</div>
                        <div class="col-8">
                            <input type="text" id="usuario" name="usuario" class="form-control form-control-sm" value="<?php echo $rowIA[0]; ?>" readonly>
                        </div>
                    </div>
                    
                    <!-- Identificación -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Identificación</div>
                        <div class="col-8">
                            <input type="text" id="identificacion" name="identificacion" class="form-control form-control-sm" value="<?php echo $rowIA[1]; ?>" readonly>
                        </div>
                    </div>
                    
                    <!-- Nombres -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Nombres</div>
                        <div class="col-8">
                            <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" value="<?php echo $rowIA[2]; ?>" readonly>
                        </div>
                    </div>
                    
                    <!-- Apellidos -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Apellidos</div>
                        <div class="col-8">
                            <input type="text" id="apellidos" name="apellidos" class="form-control form-control-sm" value="<?php echo $rowIA[3]; ?>" readonly>
                        </div>
                    </div>  
                    
                    
                    <!-- Unidad -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4"><label for="unidad">Unidad</label></div>
                        <div class="col-8">
                            <select name="unidad" id="unidad" class="form-control form-control-sm">
                                <option value="" selected>Seleccione una unidad...</option>   
                                <?php 
                                    }

                                    $objetoUnidadDao = new unidadDao();
                                    $resultadoUnidades = $objetoUnidadDao->listarUnidadesActivas();
                                    foreach($resultadoUnidades as $rowUD){ 
                                ?>
                                    <option value="<?php echo $rowUD[0]; ?>"><?php echo $rowUD[1]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Tipo Monitoreo -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4"><label for="unidad">Tipo monitoreo</label></div>
                        <div class="col-8">
                            <select name="tipo-monitoreo" id="tipo-monitoreo" class="form-control form-control-sm">
                                <option value="">Seleccione el tipo de monitoreo...</option>
                                <?php
                                    $objetoTipoMonitoreoDao = new tipoMonitoreoDao(); 
                                    $resultadoTMA = $objetoTipoMonitoreoDao->tiposMonitoreosActivos();
                                    foreach($resultadoTMA as $rowTMA){ 
                                ?>
                                <option value="<?php echo $rowTMA[0]; ?>"><?php echo $rowTMA[1]; ?></option>
                                <?php
                                    };
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Fecha Monitoreo -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Fecha Monitoreo</div>
                        <div class="col-8">
                            <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" value="<?php echo date("Y"); ?>-<?php echo date("m"); ?>-<?php echo date("d"); ?>">
                        </div>
                    </div>

                    <!-- Error crítico -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4"><label for="error-critico">Error crítico</label></div>
                        <div class="col-8">
                            <select name="error-critico" id="error-critico" class="form-control form-control-sm">
                                <option value="" selected>Seleccione el error crítico...</option>
                            <?php
                                $objetoErrorCritico = new errorCriticoDao();
                                $resultadoECA = $objetoErrorCritico->listarErroresCriticosActivos();
                                foreach($resultadoECA as $rowECA){
                            ?>
                                <option rows="2" value="<?php echo $rowECA[0]; ?>"><?php echo $rowECA[1]; ?></option>
                            <?php
                                }      
                            ?>
                            </select>
                        </div>
                    </div>
                  </div>  
                <div class="container-fluid">    
                    <!-- servicio y etiqueta telefonica -->
                    <table class="table table-borderless table-striped table-secondary mt-3">
                        <tr>
                            <th class="text-white text-center" style="background-color:#0f6ecc;" colspan="3">SERVICIO Y ETIQUETA TELEFÓNICA 
                            <?php 
                                $objetoPorcentajeSeccion1 = new ValSeccDao();
                                $porc1 = $objetoPorcentajeSeccion1->verPorcentajeSeccion("dir_com_set");
                                foreach($porc1 as $rowPorc1){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc1[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionDCS" name="valorSeccionTabla1" value="<?php echo $rowPorc1[0]; ?>">
                            <?php
                                }        
                            ?>
                            <span id="acum_dcs" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>
                            <input type="hidden" id="acum_dcs_input" name="acum_dcs_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <!-- PRIMER ITEM --> 
                        <?php
                            $objetoItemDCS = new itemDao("dcs");
                            $resultadoDCS = $objetoItemDCS->listarItemsActivos();
                            $acum1 = 0;
                            foreach($resultadoDCS as $rowDCSA){
                            $acum1++;
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowDCSA[1]; ?>
                                <small><i class="far fa-question-circle text-primary" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowDCSA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="dcs_<?php echo $rowDCSA[0]; ?>1" name="dcs_<?php echo $rowDCSA[0]; ?>" class="custom-control-input" onclick="calcular('dcs')">
                                    <label class="custom-control-label" for="dcs_<?php echo $rowDCSA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="dcs_<?php echo $rowDCSA[0]; ?>2" name="dcs_<?php echo $rowDCSA[0]; ?>" class="custom-control-input" onclick="calcular('dcs')">
                                    <label class="custom-control-label" for="dcs_<?php echo $rowDCSA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <input type="hidden" id="totalItemsDCS" name="totalItemsDCS" value="<?php echo $acum1; ?>">


                        <!-- SEGUNDO ITEM -->
                        <tr>
                            <th class="text-white text-center" style="background-color:#0f6ecc;" colspan="3">NEGOCIACIÓN
                            <?php 
                                $objetoPorcentajeSeccion2 = new ValSeccDao();
                                $porc2 = $objetoPorcentajeSeccion2->verPorcentajeSeccion("dir_com_n");
                                foreach($porc2 as $rowPorc2){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc2[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionDCN" name="valorSeccionTabla2" value="<?php echo $rowPorc2[0]; ?>">
                            <?php
                                }        
                            ?>
                            <span id="acum_dcn" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>             
                            <input type="hidden" id="acum_dcn_input" name="acum_dcn_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <?php
                            $objetoItemDCN = new itemDao("dcn");
                            $resultadoDCN = $objetoItemDCN->listarItemsActivos();
                            $acum2 = 0;
                            foreach($resultadoDCN as $rowDCNA){
                            $acum2++;   
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowDCNA[1]; ?>
                                <small><i class="far fa-question-circle text-primary" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowDCNA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="dcn_<?php echo $rowDCNA[0]; ?>1" name="dcn_<?php echo $rowDCNA[0]; ?>" class="custom-control-input" onclick="calcular('dcn')">
                                    <label class="custom-control-label" for="dcn_<?php echo $rowDCNA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="dcn_<?php echo $rowDCNA[0]; ?>2" name="dcn_<?php echo $rowDCNA[0]; ?>" class="custom-control-input" onclick="calcular('dcn')">
                                    <label class="custom-control-label" for="dcn_<?php echo $rowDCNA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        
                        <input type="hidden" id="totalItemsDCN" name="totalItemsDCN" value="<?php echo $acum2; ?>">

                        
                        <!-- CUARTO ITEM -->
                        <tr>
                            <th class="text-white text-center" style="background-color:#0f6ecc;" colspan="3">CIERRE DE COMPROMISO
                            <?php 
                                $objetoPorcentajeSeccion3 = new ValSeccDao();
                                $porc3 = $objetoPorcentajeSeccion3->verPorcentajeSeccion("dir_com_cc");
                                foreach($porc3 as $rowPorc3){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc3[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionDCC" name="valorSeccionTabla3" value="<?php echo $rowPorc3[0]; ?>">
                            <?php
                                }        
                            ?>
                            <span id="acum_dcc" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>             
                            <input type="hidden" id="acum_dcc_input" name="acum_dcc_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <?php
                            $objetoItemDCC = new itemDao("dcc");
                            $resultadoDCC = $objetoItemDCC->listarItemsActivos();
                            $acum3 = 0;
                            foreach($resultadoDCC as $rowDCCA){
                            $acum3++;   
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowDCCA[1]; ?>
                                <small><i class="far fa-question-circle text-primary" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowDCCA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="dcc_<?php echo $rowDCCA[0]; ?>1" name="dcc_<?php echo $rowDCCA[0]; ?>" class="custom-control-input" onclick="calcular('dcc')">
                                    <label class="custom-control-label" for="dcc_<?php echo $rowDCCA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="dcc_<?php echo $rowDCCA[0]; ?>2" name="dcc_<?php echo $rowDCCA[0]; ?>" class="custom-control-input" onclick="calcular('dcc')">
                                    <label class="custom-control-label" for="dcc_<?php echo $rowDCCA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        
                        <input type="hidden" id="totalItemsDCC" name="totalItemsDCC" value="<?php echo $acum3; ?>">
                        
                        <!-- CUARTO ITEM -->
                        <tr>
                            <th class="text-white text-center" style="background-color:#0f6ecc;" colspan="3">REGISTRO EN EL SISTEMA
                            <?php 
                                $objetoPorcentajeSeccion4 = new ValSeccDao();
                                $porc4 = $objetoPorcentajeSeccion4->verPorcentajeSeccion("dir_com_rs");
                                foreach($porc4 as $rowPorc4){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc4[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionDCR" name="valorSeccionTabla4" value="<?php echo $rowPorc4[0]; ?>">
                            <?php
                                }
                            ?>   
                            <span id="acum_dcr" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>
                            <input type="hidden" id="acum_dcr_input" name="acum_dcr_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <?php
                            $objetoItemDCR = new itemDao("dcr");
                            $resultadoDCR = $objetoItemDCR->listarItemsActivos();
                            $acum4 = 0;
                            foreach($resultadoDCR as $rowDCRA){
                            $acum4++;
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowDCRA[1]; ?>
                                <small><i class="far fa-question-circle text-primary" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowDCRA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="dcr_<?php echo $rowDCRA[0]; ?>1" name="dcr_<?php echo $rowDCRA[0]; ?>" class="custom-control-input" onclick="calcular('dcr')">
                                    <label class="custom-control-label" for="dcr_<?php echo $rowDCRA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="dcr_<?php echo $rowDCRA[0]; ?>2" name="dcr_<?php echo $rowDCRA[0]; ?>" class="custom-control-input" onclick="calcular('dcr')">
                                    <label class="custom-control-label" for="dcr_<?php echo $rowDCRA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <input type="hidden" id="totalItemsDCR" name="totalItemsDCR" value="<?php echo $acum4; ?>">
                        <tr class="bg-dark text-white text-right">
                            <th colspan="3">
                                <h6>
                                    <span style="background-color:#E74C3C;" id="contenedorAcumTotal" class="badge badge-light p-2 m-0">ACUMULADO TOTAL: <span id="acumTotal">0.0%</span></span>
                                </h6>
                            </th>
                        </tr>
                    </table>
                    <hr>
                    <div class="form-group">
                        <label for="llamada" class="font-weight-bold">Llamada</label>
                        <textarea name="llamada" placeholder="Ingrese el nombre de la respectiva llamada..."  id="llamada" rows="2" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fortalezas" class="font-weight-bold">Fortalezas</label>
                        <textarea name="fortalezas" placeholder="Ingrese las fortalezas de la gestión..."  id="fortalezas" rows="2" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="oportunidades" class="font-weight-bold">Oportunidades</label>
                        <textarea name="oportunidades" placeholder="Ingrese las oportunidades de mejora de la gestión..."  id="oportunidades" rows="5" class="form-control form-control-sm"></textarea>
                    </div>
                    <div>
                    <hr class="bg-white">
                        <p class="text-info font-weight-bold"><i class="far fa-question-circle"></i>&nbsp;  Tanto las fortalezas como las oportunidades deben ser separadas por asteriscos (*) como reemplazo de las viñetas</p>
                        <p class="text-danger font-weight-bold"><i class="far fa-question-circle"></i>&nbsp;  Es importante que todos los campos estén diligenciados antes de registrar</p>
                    </div>
                    <hr>
                    <button id="botonRegistrar" type="button" onclick="validarFormatoDC()" class="shadow text-white btn mb-3 font-weight-bold" style="background-color:#0f6ecc;"><i class="fas fa-plus mr-1"></i> REGISTRAR GESTIÓN</button>
                </div>
            </form>
            </div>
            <?php        
                }else{
            ?>
                <!-- SI NO HAY RESULTADOS -->
                <div class="container-fluid w-75 text-center">
                    <img src="img/busqueda-error.png" width="350" class="mt-2 mb-0" alt="icono de búsqueda">
                    <h2 class="h3 text-white mt-0">lo sentimos... <kbd class="h3">no</kbd> hay resultados para el usuario ingresado</h2>
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
</body> 
</html>