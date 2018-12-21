<!-- importaciones requeridas -->
<?php 
    require_once ("encabezadoReportes.php"); 
    require_once ("../../controlador/zonaHoraria.php");
    require_once ("../../controlador/sesiones.php");
    require_once ("../../modelo/asesorDao.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if($_SESSION["rol"]=="asesor" || $_SESSION["rol"]=="lider" || $_SESSION["rol"]=="coord_financiera" || empty($_SESSION['autenticado'])){
        header("location:../acceso_denegado.php");
    }
?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="retroalimentacionPDF.php" method="post">
            <div class="form-group input-group-sm">
                <label for="tabla" class="mb-3 w-100 h6 text-white text-center font-weight-bold">RETROALIMENTACION GENERAL</label>
                <select name="tabla" id="tabla" class="input-sm mb-3 form-control">
                    <option value="" selected disabled>Seleccione una plantilla</option>
                    <optgroup label="Venta Directa"></optgroup>
                    <option value="dc">Negociación Comercial</option>
                    <option value="dp">Negociación Prejurídica</option>
                    <option value="ie">Mensaje</option>
                    <option value="ib">Inbound</option>
                    <optgroup label="Financiera"></optgroup>
                    <option value="neg">Negociación</option>
                    <option value="men">Mensaje</option>
                    <option value="ibf">Inbound</option>
                </select>
                <input type="text" placeholder="Digite el rango de los últimos días a evaluar" name="ultimosDias" id="ultimosDias" class="input-sm mb-3 form-control">
                <input type="text" placeholder="Ingrese el puntaje tope a evaluar " name="puntaje" id="puntaje" class="input-sm mb-3 form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark btn-sm btn-block"><i class="fas fa-plus-circle"></i> GENERAR RETROALIMENTACION PDF</button>
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