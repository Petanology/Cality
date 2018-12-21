<!-- importaciones requeridas -->
<?php 
    require_once ("encabezadoReportes.php"); 
    require_once ("../../controlador/zonaHoraria.php");
    require_once ("../../controlador/sesiones.php");
    require_once ("../../modelo/asesorDao.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if($_SESSION["rol"]=="asesor" || $_SESSION["rol"]=="lider" || $_SESSION["rol"]=="coord_venta_directa" || empty($_SESSION['autenticado'])){
        header("location:../acceso_denegado.php");
    }
?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="reporteDetalladoNegociacion.php" method="post">
            <div class="form-group input-group-sm">
                <label for="mes" class="mb-3 w-100 h6 text-white text-center font-weight-bold">INFORME DETALLADO PARA NEGOCIACION FINANCIERA</label>
                <input type="month" value="<?php echo date("Y"); ?>-<?php echo date("m"); ?>" name="mesReporte" id="mes" class="input-sm mb-3 form-control">
                <input list="asesor" class="pl-3 pt-3 pb-3 form-control form-control-sm" name="asesorConsulta" id="asesorConsulta" placeholder="Seleccione o digite el asesor que desea consultar">
                <datalist id="asesor">
                    <?php
                        $objetoAsesorListaActivos = new asesorDao();
                        $resultadoListaAA = $objetoAsesorListaActivos->listarAsesoresActivos();
                        foreach ($resultadoListaAA as $rowAA){
                    ?>
                        <option value="<?php echo $rowAA[0]; ?>"><?php echo $rowAA[1]; ?></option>
                    <?php
                        }
                    ?>
                </datalist>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-sm btn-block"><i class="fas fa-plus-circle"></i> GENERAR ARCHIVO PDF</button>
                <small class="form-text text-secondary font-weight-bold"><i class="far fa-question-circle"></i>&nbsp; por favor, seleccione un mes que contenga gestiones, además recuerde que solo puede consultar un asesor que se encuentre activo para realizar sus informe detallado.</small>
            </div>
        </form>
    </div>
    <!-- Javascript Bootstrap -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/carga-pagina.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body> 
</html>