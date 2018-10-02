<!-- importaciones requeridas -->
<?php require_once ("../modelo/asesorDao.php"); ?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido --> 
    <div class="conainer-fluid p-3">
        <!-- PRIMER SECCION -->
        <div class="container-fluid rounded bg-white">
            <form action="" method="post">
                <h6 class="pt-3 font-weight-bold">Búsqueda de Usuario</h6> 
                <div class="form-group">  
                    <div class="input-group">
                        <input list="browsers" class="form-control form-control-sm" name="asesorConsulta" id="asesorConsulta" placeholder="Seleccione o digite el asesor que desea gestionar">
                            <datalist id="browsers">
                                <option value="hgarzon">Héctor Julio Garzón
                                <option value="phoyos">Paula Andrea Hoyos Atuesta
                            </datalist>
                        <div class="input-group-append">
                            <button type="submit" value="MODIFICAR" name="boton" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> CONSULTAR</button>
                        </div>
                    </div>
                    <small class="pb-2 form-text text-muted font-weight-bold"><i class="far fa-question-circle"></i>&nbsp; Tenga en cuenta que puede buscar al asesor por medio del usuario o el nombre</small>
                </div>
            </form>
        </div>

        <!-- SEGUNDA SECCION -->
        <div class="rounded bg-white">
            <form action="../controlador/gestionControlador.php" method="post">
                <p class="bg-primary rounded-top font-weight-bold pt-3 text-white p-3">Area de Calidad - Formato Calidad Etapas Comerciales Venta Directa</p>
                
                <div class="container">
                    <p class="font-weight-bold text-center mb-0">INFORMACIÓN GENERAL</p>
                    <hr class="m-2">                    
                    <!-- Usuario --> 
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Usuario</div>
                        <div class="col-8">
                            <input type="text" id="usuario" name="usuario" class="form-control form-control-sm" value="gsanchez" disabled>
                        </div>
                    </div>
                    
                    <!-- Identificación -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Identificación</div>
                        <div class="col-8">
                            <input type="text" id="identificacion" name="identificacion" class="form-control form-control-sm" value="1000601871" disabled>
                        </div>
                    </div>
                    
                    <!-- Nombres -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Nombres</div>
                        <div class="col-8">
                            <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" value="Héctor Julio" disabled>
                        </div>
                    </div>
                    
                    <!-- Apellidos -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4">Apellidos</div>
                        <div class="col-8">
                            <input type="text" id="apellidos" name="apellidos" class="form-control form-control-sm" value="Garzón" disabled>
                        </div>
                    </div>                     
                    
                    <!-- Unidad -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4"><label for="unidad">Unidad</label></div>
                        <div class="col-8">
                            <select name="unidad" id="unidad" class="form-control form-control-sm">
                                <option value="ejemplo">Ejemplo1</option>
                                <option value="ejemplo">Ejemplo2</option>
                                <option value="ejemplo">Ejemplo3</option>
                            </select>
                        </div>
                    </div>                    
                    
                    <!-- Tipo Monitoreo -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="font-weight-bold col-4"><label for="unidad">Tipo monitoreo</label></div>
                        <div class="col-8">
                            <select name="tipo-monitoreo" id="tipo-monitoreo" class="form-control form-control-sm">
                                <option value="ejemplo">Grabación1</option>
                                <option value="ejemplo">Grabación2</option>
                                <option value="ejemplo">Grabación3</option>
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
                        <div class="font-weight-bold col-4"><label for="unidad">Error crítico</label></div>
                        <div class="col-8">
                            <select name="error-critico" id="error-critico" class="form-control form-control-sm">
                                <option value="ejemplo">Ninguno</option>
                                <option value="ejemplo">Grabación2</option>
                                <option value="ejemplo">Grabación3</option>
                            </select>
                        </div>
                    </div>
                    
                    <p class="bg-primary text-white font-weight-bold text-center p-2 mb-3 mt-3">SERVICIO Y ETIQUETA TELEFÓNICA</p>
                    
                    <!-- servicio y etiqueta telefonica -->
                    <div class="row align-items-center pt-1 pb-1">
                        <div class="col-8 font-weight-bold">Enunciado</div>
                        <div class="col-2 text-center font-weight-bold">SI</div>
                        <div class="col-2 text-center font-weight-bold">NO</div>   
                    </div>
                           
                    <div class="row align-items-center">
                        <div class="col-8">
                            <p class="font-weight-bold">Saluda Identifica a la consultora de forma correcta</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <!-- innecesarios de momento --> 
    <!--<script src="js/bootstrap.min.js"></script>-->
</body> 
</html>