<div class="modal fade" id="form_genero1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Genero</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="../controlador/generoControlador.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="mb-3 form-control" id="nombre" name="nombre" placeholder="Digite el nuevo genero">
                        <button type="submit" value="REGISTRAR" name="boton" class="btn btn-success">REGISTRAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>