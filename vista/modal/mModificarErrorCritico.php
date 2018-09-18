<div class="modal fade" id="form_error_critico2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Error Crítico</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/errorCriticoControlador.php" method="post">
            <div class="modal-body">
                    <div class="form-group">

                        <!-- Identificación -->
                        <div class="form-group">
                            <label for="id2">Identificación</label>
                            <input type="text" value="<?php echo $rowLI[0]; ?>" class="form-control" id="id2" name="id2" placeholder="Aquí debe visualizar la identificación" readonly>
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la identificación no se puede modificar</small>
                        </div>

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="nombre2">Nombre</label>
                            <input type="text" value="<?php echo $rowLI[1]; ?>" class="form-control" id="nombre2" name="nombre2" placeholder="Digite el nuevo error critico">
                        </div>

                        <!-- Estado -->
                        <div class="form-group">
                            <label for="estado2">Estado</label>
                            <select name="estado2" id="estado2" class="form-control">
                                <option value="" disabled>Seleccione el estado</option>
                                <option value="1" <?php if($rowLI[2]==1){ echo "selected"; } ?>>Activo</option>
                                <option value="0" <?php if($rowLI[2]==0){ echo "selected"; } ?>>Inactivo</option>
                            </select>
                        </div>
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