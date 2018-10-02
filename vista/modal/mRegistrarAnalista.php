<?php
    // importaciones requeridas
    require_once ("../modelo/tipoDocDao.php");
    require_once ("../modelo/generoDao.php");
?>

   <div class="modal fade" id="form_analista1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Analista</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/analistaControlador.php" method="post">
                <div class="modal-body">

                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label for="tipoDocumento">Tipo de documento</label>
                            <select name="tipoDocumento" id="tipoDocumento" class="mb-3 form-control">
                                <option value="" selected disabled>Seleccione el tipo de documento...</option>
                                <?php
                                    $objetoTD = new tipoDocDao();
                                    $formTipoDoc = $objetoTD->formTipoDoc();
                                    foreach($formTipoDoc as $rowFTD):                
                                ?>
                                <option value="<?php echo $rowFTD[0]; ?>"><?php echo $rowFTD[1]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <!-- Número de identificación -->
                        <div class="form-group">
                            <label for="identificacion">Identificación</label>
                            <input type="text" class="mb-3 form-control" id="identificacion" name="identificacion" placeholder="Digite la identificación">
                        </div>


                        <!-- Nombres -->                  
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="mb-3 form-control" id="nombres" name="nombres" placeholder="Digite el nombre">
                        </div>


                        <!-- Apellidos -->
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="mb-3 form-control" id="apellidos" name="apellidos" placeholder="Digite los apellidos">
                        </div>


                        <!-- Genero -->
                        <label>Genero</label>
                        <div class="form-group">
                            <?php
                                $objetoG = new generoDao();
                                $formGenero = $objetoG->formGenero();
                                foreach($formGenero as $rowG):                
                            ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="genero" id="genero<?php echo $rowG[0]; ?>" value="<?php echo $rowG[0]; ?>" class="custom-control-input">
                                    <label class="custom-control-label" for="genero<?php echo $rowG[0]; ?>"><?php echo $rowG[1]; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <!-- Correo Electrónico -->
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" class="mb-3 form-control" id="correo" name="correo" placeholder="Digite el correo electrónico" required>
                        </div>

                        <!-- Usuario -->
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="mb-3 form-control" id="usuario" name="usuario" placeholder="Digite un usuario de sesión">
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="mb-3 form-control" id="contrasena" name="contrasena" placeholder="Digite la contraseña">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="REGISTRAR" name="boton" class="btn btn-success">REGISTRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>