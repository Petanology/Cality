<div class="modal fade" id="form_item2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar <?php echo $enunciado; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/itemControlador.php" method="post">
            
            <input type="hidden" value="<?php echo $nomTabla; ?>" name="tabla">
            <div class="modal-body">
                    <div class="form-group">

                        <!-- Identificación -->
                        <div class="form-group">
                            <label for="id2">Identificación</label>
                            <input type="text" value="<?php echo $rowLI[0]; ?>" class="form-control" id="id2" name="id2" placeholder="Aquí debe visualizar la identificación" readonly>
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la identificación no se puede modificar</small>
                        </div>

                        <!-- Título -->
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input 
                                type="text" 
                                value="<?php echo $rowLI[1]; ?>" 
                                class="form-control"
                                id="titulo2" 
                                name="titulo2" 
                                placeholder="Digite el nuevo titulo"
                                title="Texto (multicarácter) entre 10 y 150 carácteres"
                                pattern=".{10,150}"
                                required
                            >
                        </div>
                        
                        
                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion2">Descripción</label>
                            <textarea 
                                placeholder="Digite la nueva descripcion" 
                                name="descripcion2" 
                                id="descripcion2" 
                                class="form-control" 
                                rows="3"
                                minlength="10"
                                maxlength="1300"
                                onfocus="contarCaracteresM()"
                                onkeyup="contarCaracteresM()"
                                required
                            ><?php echo $rowLI[2]; ?></textarea>
                            <small class="form-text text-muted mb-2"><i class="fas fa-sort-numeric-up"></i>&nbsp; <b><span id="contenedorCaracteres2">0</span> carácteres actuales,</b> recuerde que la descripción tiene un límite de <b>1300 carácteres</b></small>
                        </div>                        
                        <?php
                            if(date("j") >= 28 AND date("j") <= 31){
                        ?>
                            <!-- Estado -->
                            <div class="form-group">
                                <label for="estado2">Estado</label>
                                <select name="estado2" id="estado2" class="form-control">
                                    <option value="" disabled>Seleccione el estado</option>
                                    <option value="1" <?php if($rowLI[3]==1){ echo "selected"; } ?>>Activo</option>
                                    <option value="0" <?php if($rowLI[3]==0){ echo "selected"; } ?>>Inactivo</option>
                                </select>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" value="<?php echo $rowLI[3]; ?>" name="estado2">
                        <?php } ?>
                    </div>
                    <hr>
                    <small class="form-text text-muted border-right"><i class="far fa-question-circle"></i>&nbsp; Recuerde que el estado del item sólo puede ser modificado finalizando mes, <strong>después de éste cambio no registre ninguna gestión con el determinado número de items dentro del mismo mes. Cada formato tomará estos valores por defecto y ésto podría afectar los informes de Cality.</strong></small>
            </div>
                <div class="modal-footer">
                    <button type="submit" value="MODIFICAR" name="boton" class="btn btn-success">MODIFICAR</button>
                    <button type="button" name="boton" data-dismiss="modal" class="btn btn-secondary">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>