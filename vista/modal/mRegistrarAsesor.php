<?php
    // importaciones requeridas
    require_once ("../modelo/tipoDocDao.php");
    require_once ("../modelo/generoDao.php");
    require_once ("../modelo/liderDao.php");
?>

   <div class="modal fade" id="form_asesor1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Registrar Asesor</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/asesorControlador.php" method="post">
                <div class="modal-body">

                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label for="tipoDocumento">Tipo de documento</label>
                            <select name="tipoDocumento" id="tipoDocumento" class="mb-3 form-control" required>
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
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="identificacion" 
                                name="identificacion" 
                                placeholder="Digite la identificación"
                                title="Sólo números entre 7 y 15 carácteres"
                                pattern="[1234567890]{7,15}"
                                required
                            >
                        </div>


                        <!-- Nombres -->                  
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control"
                                id="nombres" 
                                name="nombres"
                                placeholder="Digite el nombre"
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                required
                            >
                        </div>


                        <!-- Apellidos -->
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="apellidos" 
                                name="apellidos"
                                placeholder="Digite los apellidos"
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" 
                                required
                            >
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
                                    <input 
                                        type="radio" 
                                        name="genero" 
                                        id="genero<?php echo $rowG[0]; ?>" 
                                        value="<?php echo $rowG[0]; ?>" class="custom-control-input"
                                        required
                                    >
                                    <label class="custom-control-label" for="genero<?php echo $rowG[0]; ?>"><?php echo $rowG[1]; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <!-- Correo Electrónico -->
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input 
                                type="email" 
                                class="mb-3 form-control" 
                                id="correo" 
                                name="correo" 
                                placeholder="Digite el correo electrónico"
                                required
                            >
                        </div>

                        <!-- Líder correspondiente -->
                        <div class="form-group">
                            <label for="lider">Líder</label>
                            <select name="lider" id="lider" class="mb-3 form-control" required>
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
                            <input 
                                type="text" 
                                class="mb-3 form-control"
                                id="usuario" 
                                name="usuario" 
                                placeholder="Digite un usuario de sesión"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{4,35}"
                                required
                            >
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input 
                                type="password"    
                                class="mb-3 form-control" 
                                id="contrasena" 
                                name="contrasena" 
                                title="Cadena de texto entre 4 y 35 carácteres"
                                pattern=".{4,35}"
                                placeholder="Digite la contraseña"
                                required
                            >
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