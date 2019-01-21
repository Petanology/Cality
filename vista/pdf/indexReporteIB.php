<!-- importaciones requeridas -->
<?php 
    require_once ("../../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    $piso = 0;
    if(isset($_SESSION['piso'])){
        $piso = $_SESSION['piso'];
    }
    
    if(empty($_SESSION['autenticado'])){
        header("location:../acceso_denegado.php");
    } else if($_SESSION['rol'] == "coord_financiera"){
        header("location:../acceso_denegado.php");
    } else if($piso == 3){
        header("location:../acceso_denegado.php");
    }

    require_once ("encabezadoReportes.php");
    require_once ("../../controlador/zonaHoraria.php");
?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="reportePromedioInbound.php" class="bg-dark p-3 rounded" method="GET">
            <div class="form-group input-group-sm">
                <label for="mes" class="mb-3 w-100 h6 text-white text-center font-weight-bold">INFORME MENSUAL INBOUND - VENTA DIRECTA</label>
                
                <label for="mes" style="color:#DDD;" class="pt-1 pb-1 font-weight-bold">Seleccionar mes</label> 
                
                <input type="month" value="<?php echo date("Y"); ?>-<?php echo date("m"); ?>" name="mesReporte" id="mes" class="input-sm mb-3 form-control" required>
                <small style="color:#AAA;" class="form-text font-weight-bold mt-2 mb-2"><i class="far fa-question-circle"></i>&nbsp; por favor, seleccione un mes que contenga gestiones, para así generar sus respectivos informes generales.</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm btn-block font-weight-bold"
                ><i class="fas fa-award"></i>&nbsp; GENERAR ARCHIVO PDF</button>
            </div>
        </form>
    </div>
    <!-- Javascript Bootstrap -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/carga-pagina.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body> 
</html>
