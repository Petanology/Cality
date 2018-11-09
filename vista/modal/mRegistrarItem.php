<div class="modal fade" id="form_item1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar <?php echo $enunciado; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/itemControlador.php" method="post">
                <div class="modal-body">
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
                            <small class="form-text text-muted mb-2"><i class="far fa-question-circle"></i>&nbsp; <b><span id="contenedorCaracteres">0</span> carácteres actuales,</b> recuerde que la descripción tiene un límite de <b>1300 carácteres</b></small>
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