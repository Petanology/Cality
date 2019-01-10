<div class="modal fade" id="form_unidad1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Unidad</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="../controlador/unidadControlador.php" method="post"  autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input 
                            type="text" 
                            class="mb-3 form-control" 
                            id="nombre" 
                            name="nombre" 
                            placeholder="Digite la nueva unidad"
                            title="Cadena de texto entre 4 y 35 carácteres"
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ- ]{4,35}"
                            required
                            >
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