<div class="modal fade" id="form_valSecc2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Modificar porcentaje</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/valSeccControlador.php" method="post">
            <div class="modal-body">                        
                        <!-- Identificación -->
                        <div class="form-group">
                            <input type="hidden" id="identificacion2" name="identificacion2" value="<?php echo $rowA[0]; ?>">
                        </div>
                       
                        <!-- Descripcion -->                  
                        <div class="form-group">
                            <label for="desc2" class="font-weight-bold">Grupo</label>
                            <p><?php echo $rowA[3]; ?> - <?php echo $rowA[1]; ?></p>
                        </div>
                        
                        <!-- Valor -->
                        <div class="form-group">
                            <label for="valor2" class="font-weight-bold">Valor</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="valor2" name="valor2" 
                                placeholder="Digite el nuevo valor de la sección" 
                                value="<?php echo $rowA[2]; ?>"
                                pattern="[1234567890. ]{1,4}"
                                title='Se permiten solo puntos y números positivos coherentes, ejemplo: "40.0"'
                                required
                                >
                            <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que los porcentajes de todas las gestiones del mes se basan en la primera gestión realizada. por lo que para evitar confusiones, se recomienda hacer un cambio de estos, <strong>un día antes de iniciar un nuevo mes.</strong></small>
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