<!-- importaciones requeridas -->
<?php require_once ("encabezadoReportes.php"); ?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="reportePromedioContactoDirecto.php" method="post">
            <div class="form-group input-group-sm">
                <label for="mes" class="mb-3 w-100 h6 text-white text-center font-weight-bold">Mes</label>
                <input type="month" name="mesReporte" id="mes" class="input-sm mb-3 form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm btn-block"
                ><i class="fas fa-plus-circle"></i> GENERAR ARCHIVO PDF</button>
                <small class="form-text text-secondary font-weight-bold"><i class="far fa-question-circle"></i>&nbsp; por favor, seleccione un mes que contenga gestiones, para así generar sus respectivos informes generales.</small>
            </div>
        </form>
    </div>
    <!-- Javascript Bootstrap -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/carga-pagina.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body> 
</html>
