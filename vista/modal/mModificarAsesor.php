<div class="modal fade" id="form_asesor2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Modificar Asesor</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/asesorControlador.php" method="post" autocomplete="off">
            <div class="modal-body">
                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label for="tipoDocumento2" class="font-weight-bold">Tipo de documento</label>
                            <select name="tipoDocumento2" id="tipoDocumento2" class="mb-3 form-control" required>
                                <option value="" disabled>Seleccione el tipo de documento...</option>
                                <optgroup label="Tipo de documento registrado">
                                    <?php if($rowA[0]!=null): ?>
                                        <option value="<?php echo $rowA[0]; ?>" selected><?php echo $rowA[1]; ?></option>
                                    <?php endif; ?>                                
                                </optgroup>
                                <optgroup label="Vigentes">
                                    <?php
                                        $rowA[1];
                                        $objetoTD = new tipoDocDao();
                                        $formTipoDoc = $objetoTD->formTipoDoc();
                                        foreach($formTipoDoc as $rowFTD):                
                                    ?>
                                    <option value="<?php echo $rowFTD[0]; ?>"><?php echo $rowFTD[1]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        
                        <hr>

                        <!-- Número de identificación -->
                        <div class="form-group">
                            <label for="identificacion2" class="font-weight-bold">Identificación</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="identificacion2" 
                                name="identificacion2" 
                                placeholder="Digite la identificación" 
                                value="<?php echo $rowA[2]; ?>" 
                                title="Sólo números entre 7 y 15 carácteres"
                                pattern="[1234567890]{7,15}"
                                required
                                readonly
                            >
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la identificación no se puede modificar</small>
                        </div>

                        <hr>
                       
                        <!-- Nombres -->                  
                        <div class="form-group">
                            <label for="nombres2" class="font-weight-bold">Nombres</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" id="nombres2" 
                                name="nombres2" 
                                placeholder="Digite el nombre" 
                                value="<?php echo $rowA[3]; ?>"
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                required
                            >
                        </div>


                        <!-- Apellidos -->
                        <div class="form-group">
                            <label for="apellidos2" class="font-weight-bold">Apellidos</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="apellidos2" 
                                name="apellidos2" 
                                placeholder="Digite los apellidos" 
                                value="<?php echo $rowA[4]; ?>"
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                required
                            >
                        </div>


                        <hr>
                        <!-- Genero -->
                        <label class="font-weight-bold">Genero</label>
                        <div class="form-group">
                            <?php
                                $objetoG = new generoDao();
                                $formGenero = $objetoG->formGenero();
                                foreach($formGenero as $rowG):                
                            ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="genero2" id="genero2<?php echo $rowG[0]; ?>" value="<?php echo $rowG[0]; ?>" class="custom-control-input" <?php if($rowA[5]==$rowG[0]){echo "checked";} ?> required>
                                    <label class="custom-control-label" for="genero2<?php echo $rowG[0]; ?>"><?php echo $rowG[1]; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <hr>
                       
                        <!-- Líder correspondiente -->
                        <div class="form-group">
                            <label for="lider2" class="font-weight-bold">Líder</label>
                            <select name="lider2" id="lider2" class="mb-3 form-control" required>
                                <option value="" disabled>Seleccione el lider...</option>
                                <optgroup label="Líder registrado">
                                    <option value="<?php echo $rowA[7]; ?>" selected><?php echo $rowA[8];?></option>
                                </optgroup>
                                <optgroup label="Vigentes">
                                    <?php
                                        $objetoL = new liderDao();
                                        $formLider = $objetoL->formLider();
                                        foreach ($formLider as $rowL):
                                    ?>
                                    <option value="<?php echo $rowL[0]; ?>"><?php echo $rowL[1]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        
                        <hr>

                        <!-- Usuario -->
                        <div class="form-group">
                            <label for="usuario2" class="font-weight-bold">Usuario</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="usuario2" 
                                name="usuario2" 
                                placeholder="Digite un usuario de sesión" 
                                value="<?php echo $rowA[9]; ?>"
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{4,35}"
                                required
                            >
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; el nombre de usuario debe ser personal e intransferible</small>
                        </div>
                        
                        <hr>
                        
                        <!-- Fecha de Ingreso -->
                        <div class="form-group">
                            <label for="fecha_ingreso2" class="font-weight-bold">Fecha de ingreso</label>
                            <input 
                                type="date" 
                                class="mb-3 form-control"
                                id="fecha_ingreso2" 
                                value="<?php echo $rowA[10]; ?>"
                                name="fecha_ingreso2" 
                                placeholder="Ingrese la fecha de ingreso del gestor"
                                required
                            >
                        </div>
                        
                        <hr>

                        <!-- Estado -->
                        <div class="form-group">
                            <label for="estado2" class="font-weight-bold">Estado</label>
                            <select name="estado2" id="estado2" class="form-control" required>
                                <option value="" disabled>Seleccione el estado</option>
                                <option value="1" <?php if($rowA[11]==1){ echo "selected"; } ?>>Activo</option>
                                <option value="0" <?php if($rowA[11]==0){ echo "selected"; } ?>>Inactivo</option>
                            </select>
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