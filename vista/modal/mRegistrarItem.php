<div class="modal fade" id="form_item1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar <?php echo $enunciado; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="../controlador/itemControlador.php" method="post">
                    <input type="hidden" value="<?php echo $nomTabla; ?>" name="tabla">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="mb-3 form-control" id="titulo" name="titulo" placeholder="Digite el nuevo título">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="mb-3 form-control" name="descripcion" id="descripcion" placeholder="Digite la descripción" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" value="REGISTRAR" name="boton" class="btn btn-success">REGISTRAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>