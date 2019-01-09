<div class="modal fade" id="form_modificar_foto_perfil" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title font-weight-bold">ACTUALIZAR FOTO DE PERFIL</p>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/imagenPerfilControlador.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="form-group">
                       
                        <!-- Imagen de perfil -->
                        <div class="form-group text-center">
                            <label class="font-weight-bold">Imagen actual</label>
                        </div>
                        
                        <div class="form-group text-center">
                            <?php
                            if($rowLPACR[0] == ""){
                            ?>
                            No existe una imagen previa para mostrar, por favor seleccione una de su equipo
                            <?php
                            }else{
                            ?>
                            <img src="<?php echo $rowLPACR[0] ?>" width="250" alt="imagen de perfil" class="rounded">
                            <?php
                            }
                            ?>
                        </div>
                        
                        <hr>
                        
                        <!-- Número de identificación -->
                        <div class="form-group">
                            <label for="identificacion" class="font-weight-bold">Identificación</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="identificacion" 
                                name="identificacion"
                                value="<?php echo $rowLPACR[1] ?>"
                                readonly
                                required
                                >
                        </div>
                                                                                        
                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="nombres" class="font-weight-bold">Nombre completo</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="nombres" 
                                name="nombres"
                                value="<?php echo $rowLPACR[2] ?>"
                                readonly
                                required
                                >
                        </div>
                                                                                         
                        <label for="imagen" class="font-weight-bold">Foto de Perfil</label>
                        <!-- foto de perfil -->
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/jpg" required>
                                <label class="custom-file-label" for="imagen">Elegir imagen</label>
                            </div>
                        </div>                
                        <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la imagen debe ser formato PNG y estar en escala 1:1 (cuadrada)</small>
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