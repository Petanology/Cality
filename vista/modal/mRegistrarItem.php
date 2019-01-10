<div class="modal fade" id="form_item1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar <?php echo $enunciado; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/itemControlador.php" method="post"  autocomplete="off">
                <div class="modal-body">
                        <?php
                            if(date("j") < 28){
                        ?>
                            <i class="form-text text-muted">Sólo y exclusivamente <strong>cuando sea fin de mes, podrá registrar nuevos items,</strong>  ésto para el buen funcionamiento de los informes. Se recomienda esperar hasta hasta el respectivo rango de fecha, y una vez allí: crearlos y no realizar ninguna gestión hasta el siguiente mes.</i>
                        <?php
                            }else {
                        ?>
                        <input type="hidden" value="<?php echo $nomTabla; ?>" name="tabla">
                        <!-- Titulo -->
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input 
                                type="text" 
                                class="mb-3 form-control" 
                                id="titulo" 
                                name="titulo" 
                                placeholder="Digite el nuevo título"
                                title="Texto (multicarácter) entre 10 y 150 carácteres"
                                pattern=".{10,150}"
                                required
                            >
                        </div>
                    
                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea 
                                placeholder="Digite la descripción" 
                                name="descripcion" 
                                id="descripcion" 
                                class="mb-3 form-control"
                                rows="3"
                                minlength="10"
                                maxlength="1300"
                                onfocus="contarCaracteresR()"
                                onkeyup="contarCaracteresR()"
                                required
                            ></textarea>
                            <small class="form-text text-muted mb-2"><i class="fas fa-sort-numeric-up"></i>&nbsp; <b><span id="contenedorCaracteres">0</span> carácteres actuales,</b> recuerde que la descripción tiene un límite de <b>1300 carácteres</b></small>
                        </div>
                        <?php    
                            }
                        ?>
                </div>
                <div class="modal-footer">
                    <?php
                        if(date("j") >= 28 AND date("j") <= 31){
                    ?>
                        <button type="submit" value="REGISTRAR" name="boton" class="btn btn-success">REGISTRAR</button>
                    <?php
                        }
                    ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>