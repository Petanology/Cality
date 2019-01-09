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
            <form action="../controlador/asesorControlador.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label for="tipoDocumento" class="font-weight-bold">Tipo de documento</label>
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
                            <label for="identificacion" class="font-weight-bold">Identificación</label>
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
                            <label for="nombres" class="font-weight-bold">Nombres</label>
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
                            <label for="apellidos" class="font-weight-bold">Apellidos</label>
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
                        
                        <hr>

                        <!-- Líder -->
                        <div class="form-group">
                            <label for="lider" class="font-weight-bold">Líder</label>
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
                        
                        <hr>

                        <!-- Usuario -->
                        <div class="form-group">
                            <label for="usuario" class="font-weight-bold">Usuario</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control"
                                id="usuario" 
                                name="usuario" 
                                placeholder="Digite un usuario de sesión"
                                title="cadena de texto entre 4 y 35 carácteres"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{4,35}"
                                required
                            >
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; el nombre de usuario debe ser personal e intransferible</small>
                        </div>
                        
                        
                        <hr>
                                      
                        <label for="inputGroupFile02" class="font-weight-bold">Foto de Perfil</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" accept=".jpg" class="custom-file-input" id="inputGroupFile02" name="imagen" required>
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Elegir imagen</label>
                          </div>
                        </div>
                                                                                                            
                        <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la imagen debe estar en formato JPG</small>
                        
                        <hr>
                        
                        <!-- Fecha de Ingreso -->
                        <div class="form-group">
                            <label for="fecha_ingreso" class="font-weight-bold">Fecha de ingreso</label>
                            <input 
                                type="date" 
                                class="mb-3 form-control"
                                id="fecha_ingreso" 
                                name="fecha_ingreso" 
                                placeholder="Ingrese la fecha de ingreso del gestor"
                                required
                            >
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="submit" value="REGISTRAR" name="boton" id="boton" class="btn btn-success">REGISTRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>










