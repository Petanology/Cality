<div class="modal fade" id="form_valSecc2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Modificar porcentaje</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/valSeccControlador.php" method="post"  autocomplete="off">
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
                                <?php 
                                    if(date("j") < 28){
                                        echo "disabled";
                                    }
                                ?>
                                required
                                >
                        </div>
            </div>
                <div class="modal-footer">
                    <small class="form-text text-muted border-right pr-2 mr-4"><i class="far fa-question-circle"></i>&nbsp; Recuerde que los porcentajes solo pueden ser modificados finalizando mes, <strong>después de éste cambio no registre ninguna gestión dentro del mismo mes. Cada formato tomará estos valores por defecto y con ellos hará calculos y promedios para los respectivos informes.</strong></small>
                    <?php
                        if(date("j") >= 28 AND date("j") <= 31){
                    ?>
                       
                        <button type="submit" value="MODIFICAR" name="boton" class="btn btn-success">MODIFICAR</button>
                        
                    <?php
                        }                    
                    ?>
                    <button type="button" name="boton" data-dismiss="modal" class="btn btn-secondary">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>