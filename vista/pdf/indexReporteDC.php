<!-- importaciones requeridas -->
<?php 
    require_once ("../../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if(empty($_SESSION['autenticado'])){
        header("location:../acceso_denegado.php");
    } else if($_SESSION['rol'] == "coord_financiera"){
        header("location:../acceso_denegado.php");
    }

    require_once ("encabezadoReportes.php");
    require_once ("../../controlador/zonaHoraria.php");
?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="reportePromedioContactoDirecto.php" method="GET">
            <div class="form-group input-group-sm">
                <label for="mes" class="mb-3 w-100 h6 text-white text-center font-weight-bold">INFORME MENSUAL DE NEGOCIACION COMERCIAL - VENTA DIRECTA</label>
                <input type="month" value="<?php echo date("Y"); ?>-<?php echo date("m"); ?>" name="mesReporte" id="mes" class="input-sm mb-3 form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark btn-sm font-weight-bold btn-block"
                ><i class="fas fa-award"></i>&nbsp; GENERAR ARCHIVO PDF</button>
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
