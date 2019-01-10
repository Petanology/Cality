<div class="modal fade" id="form_error_critico1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Error Critico</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/errorCriticoControlador.php" method="post"  autocomplete="off">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="mb-3 form-control" id="nombre" name="nombre" 
                            title="cadena de texto entre 4 y 700 carácteres" placeholder="Digite el nuevo error critico"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,700}"
                            required>
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