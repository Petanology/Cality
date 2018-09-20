<div class="modal fade" id="form_asesor2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Asesor</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/asesorControlador.php" method="post">
            <div class="modal-body">
                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label for="tipoDocumento">Tipo de documento</label>
                            <select name="tipoDocumento" id="tipoDocumento" class="mb-3 form-control">
                                <option value="" selected disabled>Seleccione el tipo de documento...</option>
                                <?php if($rowA[0]!=null): ?>
                                    <option value="<?php echo $rowA[0]; ?>" selected><?php echo $rowA[1]; ?></option>
                                <?php endif; ?>                                
                                <option value="" disabled>------------------------</option>
                                <?php
                                    $rowA[1];
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
                            <label for="identificacion2">Identificación</label>
                            <input type="text" class="mb-3 form-control" id="identificacion2" name="identificacion2" placeholder="Digite la identificación" value="<?php echo $rowA[2]; ?>" readonly>
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la identificación no se puede modificar</small>
                        </div>


                        <!-- Nombres -->                  
                        <div class="form-group">
                            <label for="nombres2">Nombres</label>
                            <input type="text" class="mb-3 form-control" id="nombres2" name="nombres2" placeholder="Digite el nombre" value="<?php echo $rowA[3]; ?>">
                        </div>


                        <!-- Apellidos -->
                        <div class="form-group">
                            <label for="apellidos2">Apellidos</label>
                            <input type="text" class="mb-3 form-control" id="apellidos2" name="apellidos2" placeholder="Digite los apellidos" value="<?php echo $rowA[4]; ?>">
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
                                    <input type="radio" name="genero2" id="genero2-<?php echo $rowG[0]; ?>" value="<?php echo $rowG[0]; ?>" class="custom-control-input" <?php if($rowA[5]==$rowG[0]){echo "checked";} ?>>
                                    <label class="custom-control-label" for="genero2-<?php echo $rowG[0]; ?>"><?php echo $rowG[1]; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <!-- Correo Electrónico -->
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" class="mb-3 form-control" id="correo" name="correo" placeholder="Digite el correo electrónico" required>
                        </div>

                        <!-- Líder correspondiente -->
                        <div class="form-group">
                            <label for="lider">Líder</label>
                            <select name="lider" id="lider" class="mb-3 form-control">
                                <option value="" disabled selected>Seleccione el lider...</option>
                                <?php
                                    $objetoL = new liderDao();
                                    $formLider = $objetoL->formLider();
                                    foreach ($formLider as $rowL):
                                ?>
                                <option value="<?php echo $rowL[0]; ?>"><?php echo $rowL[1]; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                    <button type="submit" value="MODIFICAR" name="boton" class="btn btn-success">MODIFICAR</button>
                    <button type="button" name="boton" data-dismiss="modal" class="btn btn-secondary">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>