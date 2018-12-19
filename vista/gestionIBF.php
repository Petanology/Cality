<!-- importaciones requeridas -->
<?php 
    require_once ("../modelo/asesorDao.php"); 
    require_once ("../modelo/unidadDao.php"); 
    require_once ("../modelo/tipoMonitoreoDao.php"); 
    require_once ("../modelo/errorCriticoDao.php");
    require_once ("../modelo/itemDao.php");
    require_once ("../modelo/ValSeccDao.php");
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if($_SESSION['rol'] != "analista" || empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->
    <div class="conainer-fluid p-3">
        <!-- PRIMERA SECCION -->
        <div class="container-fluid rounded bg-dark border-info text-white">
            <form action="" method="post">
                <h6 class="pt-3 pb-2 font-weight-bold">Búsqueda de Usuario</h6> 
                <div class="form-group">  
                    <div class="input-group">
                        <input list="asesores-consulta" class="pl-3 pt-3 pb-3 form-control form-control-sm" name="asesorConsulta" id="asesorConsulta" placeholder="Seleccione o digite el asesor que desea gestionar">
                            <datalist id="asesores-consulta">
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
                        <div class="input-group-append">
                            <button type="submit" value="MODIFICAR" name="boton-consultar" class="btn btn-sm btn-info"><i class="fas fa-search pl-4 pr-4"></i></button>
                        </div>
                    </div>
                    <small class="pt-2 pb-3 form-text"><i class="far fa-question-circle"></i>&nbsp; Tenga en cuenta que puede buscar al asesor por medio del usuario o el nombre</small>
                </div>
            </form>
        </div>
        
        
        <?php if(isset($_POST['boton-consultar'])){ ?>
            <!-- PRIMERA SECCION -->
            <?php 
                $aIngresado = $_POST['asesorConsulta'];
                $objetoAsesorDao1 = new asesorDao();
                $siHayUsuario = $objetoAsesorDao1->saberExistenciaUsuario($aIngresado);
                $ejemplo1 = null;
                foreach($siHayUsuario as $rowSEU){
                    $ejemplo1 = $rowSEU;
                }
                if(isset($ejemplo1)){
            ?>
                <div class="rounded shadow-lg bg-white">
                <form name="formGeneral" action="../controlador/gestionIBFControlador.php" method="post">
                <p class="bg-info rounded-top font-weight-bold pt-3 text-white p-3">Area de Calidad - Formato Calidad In Bound</p>
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
                            <input type="text" id="usuario" name="usuario" class="form-control form-control-sm" value="<?php echo $rowIA[0]; ?>" disabled>
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
                            <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" value="<?php echo $rowIA[2]; ?>" disabled>
                        </div>
                    </div>
                    
                    <!-- Apellidos -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Apellidos</div>
                        <div class="col-8">
                            <input type="text" id="apellidos" name="apellidos" class="form-control form-control-sm" value="<?php echo $rowIA[3]; ?>" disabled>
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
                            <th class="text-white bg-info text-center" colspan="3">SERVICIO Y ETIQUETA TELEFÓNICA 
                            <?php 
                                $objetoPorcentajeSeccion1 = new ValSeccDao();
                                $porc1 = $objetoPorcentajeSeccion1->verPorcentajeSeccion("in_bound_fin_set");
                                foreach($porc1 as $rowPorc1){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc1[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionIBFS" name="valorSeccionTabla1" value="<?php echo $rowPorc1[0]; ?>">
                            <?php
                                }        
                            ?>
                            <span id="acum_ibfs" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>
                            <input type="hidden" id="acum_ibfs_input" name="acum_ibfs_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <!-- PRIMER ITEM --> 
                        <?php
                            $objetoItemIBFS = new itemDao("ibfs");
                            $resultadoIBFS = $objetoItemIBFS->listarItemsActivos();
                            $acum1 = 0;
                            foreach($resultadoIBFS as $rowIBFSA){
                            $acum1++;
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowIBFSA[1]; ?>
                                <small><i class="far fa-question-circle text-info" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowIBFSA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="ibfs_<?php echo $rowIBFSA[0]; ?>1" name="ibfs_<?php echo $rowIBFSA[0]; ?>" class="custom-control-input" onclick="calcular('ibfs')">
                                    <label class="custom-control-label" for="ibfs_<?php echo $rowIBFSA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="ibfs_<?php echo $rowIBFSA[0]; ?>2" name="ibfs_<?php echo $rowIBFSA[0]; ?>" class="custom-control-input" onclick="calcular('ibfs')">
                                    <label class="custom-control-label" for="ibfs_<?php echo $rowIBFSA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <input type="hidden" id="totalItemsIBFS" name="totalItemsIBFS" value="<?php echo $acum1; ?>">


                        <!-- SEGUNDO ITEM -->
                        <tr>
                            <th class="text-white bg-info text-center" colspan="3">OBJETO DE LA LLAMADA
                            <?php 
                                $objetoPorcentajeSeccion2 = new ValSeccDao();
                                $porc2 = $objetoPorcentajeSeccion2->verPorcentajeSeccion("in_bound_fin_oll");
                                foreach($porc2 as $rowPorc2){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc2[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionIBFO" name="valorSeccionTabla2" value="<?php echo $rowPorc2[0]; ?>">
                            <?php
                                }        
                            ?>  
                            <span id="acum_ibfo" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>  
                            <input type="hidden" id="acum_ibfo_input" name="acum_ibfo_input" value="">                       
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <?php
                            $objetoItemIBFO = new itemDao("ibfo");
                            $resultadoIBFO = $objetoItemIBFO->listarItemsActivos();
                            $acum2 = 0;
                            foreach($resultadoIBFO as $rowIBFOA){
                            $acum2++;   
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowIBFOA[1]; ?>
                                <small><i class="far fa-question-circle text-info" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowIBFOA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="ibfo_<?php echo $rowIBFOA[0]; ?>1" name="ibfo_<?php echo $rowIBFOA[0]; ?>" class="custom-control-input" onclick="calcular('ibfo')">
                                    <label class="custom-control-label" for="ibfo_<?php echo $rowIBFOA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="ibfo_<?php echo $rowIBFOA[0]; ?>2" name="ibfo_<?php echo $rowIBFOA[0]; ?>" class="custom-control-input" onclick="calcular('ibfo')">
                                    <label class="custom-control-label" for="ibfo_<?php echo $rowIBFOA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <input type="hidden" id="totalItemsIBFO" name="totalItemsIBFO" value="<?php echo $acum2; ?>">
                        <!-- TERCER ITEM -->
                        <tr>
                            <th class="text-white bg-info text-center" colspan="3">REGISTRO EN EL SISTEMA
                            <?php 
                                $objetoPorcentajeSeccion3 = new ValSeccDao();
                                $porc3 = $objetoPorcentajeSeccion3->verPorcentajeSeccion("in_bound_fin_rs");
                                foreach($porc3 as $rowPorc3){
                            ?>
                            <span class="badge badge-light ml-1"><?php echo $rowPorc3[0]; ?>%</span>
                            <input type="hidden" id="valorSeccionIBFR" name="valorSeccionTabla3" value="<?php echo $rowPorc3[0]; ?>">
                            <?php
                                }        
                            ?> 
                            <span id="acum_ibfr" class="badge badge-dark ml-1 notaParcialGrupo">0.0%</span>
                            <input type="hidden" id="acum_ibfr_input" name="acum_ibfr_input" value="">
                            </th>
                        </tr>
                        <tr class="bg-dark text-white">
                            <th>Enunciado</th>
                            <th class="pl-0">SI</th>
                            <th class="pl-0">NO</th>
                        </tr>
                        <?php
                            $objetoItemIBFR = new itemDao("ibfr");
                            $resultadoIBFR = $objetoItemIBFR->listarItemsActivos();
                            $acum3 = 0;
                            foreach($resultadoIBFR as $rowIBFRA){
                            $acum3++;
                        ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $rowIBFRA[1]; ?>
                                <small><i class="far fa-question-circle text-info" data-toggle="tooltip" data-placement="bottom" title="<?php echo $rowIBFRA[2]; ?>"></i></small>
                            </td>
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" id="ibfr_<?php echo $rowIBFRA[0]; ?>1" name="ibfr_<?php echo $rowIBFRA[0]; ?>" class="custom-control-input" onclick="calcular('ibfr')">
                                    <label class="custom-control-label" for="ibfr_<?php echo $rowIBFRA[0]; ?>1"></label>
                                </div>
                            </td>                            
                            <td class="pl-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" id="ibfr_<?php echo $rowIBFRA[0]; ?>2" name="ibfr_<?php echo $rowIBFRA[0]; ?>" class="custom-control-input" onclick="calcular('ibfr')">
                                    <label class="custom-control-label" for="ibfr_<?php echo $rowIBFRA[0]; ?>2"></label>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <input type="hidden" id="totalItemsIBFR" name="totalItemsIBFR" value="<?php echo $acum3; ?>">
                        <tr class="bg-dark text-white text-right">
                            <th colspan="3">
                                <h6>
                                    <span style="background-color:#E74C3C;" id="contenedorAcumTotal" class="badge badge-light p-2 m-0">ACUMULADO TOTAL: <span id="acumTotal">0.0%</span></span>
                                </h6>
                            </th>
                        </tr>
                    </table>
                    <hr>
                    <div>
                        <label for="observacion" class="font-weight-bold">Observaciones</label>
                        <textarea name="observacion" placeholder="Ingrese un comentario u observación para indexarlo a la gestión..."  id="observacion" rows="4" class="form-control form-control-sm"></textarea>
                    </div>
                    <div>
                    <hr class="bg-white">
                        <p class="text-danger font-weight-bold"><i class="far fa-question-circle"></i>&nbsp;  Es importante que todos los campos estén diligenciados antes de registrar</p>
                    </div>
                    <hr>
                    <button id="botonRegistrar" type="button" onclick="validarFormatoIBF()" class="shadow btn btn-info mb-3 font-weight-bold"><i class="fas fa-plus mr-1"></i> REGISTRAR GESTIÓN</button>
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
        <?php } else {?>
            <!-- SI NO SE HA BUSCADO NADA -->
            <div class="container-fluid w-75 text-center">
                <img src="img/busqueda.png" width="250" class="border border-info rounded-circle m-5 p-2" style="background-color:#12a6ad;" alt="icono de búsqueda">
                <h2 class="h3 text-white mt-2">una vez consultado el usuario se podrá realizar la gestión de calidad <kbd class="bg-info">in bound financiero</kbd></h2>
            </div>
        <?php } ?>
        
    </div> 

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/calculo-en-tiempo-real.js"></script>
    
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/habilitar-tooltip.js"></script>

    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.11/sweetalert2.all.js"></script>
    <script src="js/validacionFormatoIBF.js"></script>
<script src="js/validarItems.js"></script>
</body> 
</html>