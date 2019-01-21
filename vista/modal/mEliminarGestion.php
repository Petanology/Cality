<div class="modal fade" id="form_eliminar_gestion" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../controlador/eliminacionGestionControlador.php" method="post">
            <div class="modal-body">
                <p class="font-weight-bold h5">¿Seguro que desea eliminar la gestión seleccionada? recuerde que ésta acción no tiene reversa...</p>
            </div>
                <div class="modal-footer">
                   
                    <!-- boton eliminar -->
                    <button type="submit" value="" id="boton-eliminar" name="boton-eliminar" class="btn btn-danger">Sí, eliminar</button>
                    
                    <!-- cancelar -->
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>