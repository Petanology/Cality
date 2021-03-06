<!-- importaciones requeridas -->
<?php 
    require_once ("../../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    if(empty($_SESSION['autenticado'])){
        header("location:../acceso_denegado.php");
    } else if($_SESSION['rol']=="jefe_operaciones" || $_SESSION["rol"]=="lider" || $_SESSION["rol"]=="coord_financiera"){
        header("location:../acceso_denegado.php");
    }

    require_once ("encabezadoReportes.php"); 
    require_once ("../../controlador/zonaHoraria.php");
    require_once ("../../modelo/asesorDao.php");
?>

    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        <form action="retroalimentacionPDF.php" class="bg-dark p-3 rounded" method="GET">
            <label for="tabla" class="mb-3 w-100 h6 text-white text-center font-weight-bold">RETROALIMENTACION GENERAL</label>

            <div class="form-row">
                <div class="form-group col-8">
                    <label for="tabla" class="text-white font-weight-bold">Formato</label>
                    <select name="tabla" id="tabla" class="input-sm mb-3 form-control" required>
                        <option value="" selected disabled>Seleccione un formato</option>
                        <option value="" disabled></option>
                        <optgroup label="Venta Directa"></optgroup>
                        <option value="dc">Negociación Comercial</option>
                        <option value="dp">Negociación Prejurídica</option>
                        <option value="ie">Mensaje</option>
                        <option value="ib">Inbound</option>
                        <option value="" disabled></option>
                        <optgroup label="Financiera"></optgroup>
                        <option value="neg">Negociación</option>
                        <option value="men">Mensaje</option>
                        <option value="ibf">Inbound</option>
                    </select>
                </div>
                
                <div class="form-group col-4">
                    <label for="corte" class="text-white font-weight-bold">Corte</label>
                    <select name="corte" id="corte" class="input-sm mb-3 form-control" required>
                        <option value="">Seleccione el corte a evaluar</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="ultimosDias" class="text-white font-weight-bold">Ultimos días</label>
                    <input 
                        type="number" 
                        placeholder="Digite el rango de los últimos días a evaluar"
                        name="ultimosDias" 
                        id="ultimosDias" 
                        class="input-sm mb-3 form-control"
                        min="1"
                        max="127"
                        required
                    >
                </div>
                
                <div class="form-group col-3">
                    <label for="minimo" class="text-white font-weight-bold">Nota mínima</label>
                    <input 
                        type="number" 
                        placeholder="Digite la nota mínima a evaluar" 
                        name="minimo" 
                        id="minimo" 
                        class="input-sm mb-3 form-control"
                        min="0"
                        max="100"
                        required
                    >
                </div>
                
                <div class="form-group col-3">
                    <label for="maximo" class="text-white font-weight-bold">Nota máxima</label>
                    <input 
                        type="number" 
                        placeholder="Digite la nota máxima a evaluar" 
                        name="maximo" 
                        id="maximo" 
                        class="input-sm mb-3 form-control"
                        min="1"
                        max="100"
                        required
                    >
                </div>
            </div>
            
            
            <div style="background:rgba(255,255,255,0.2);" class="rounded p-3 mb-3">
                <small class="form-text text-white font-weight-bold mt-2 mb-2"><i class="far fa-question-circle"></i>&nbsp; Los siguentes campos se encuentran llenos por defecto para la impresión del encabezado en la retroalimenación, sin embargo pueden ser modificados.</small>
                <hr>

                <div class="form-row">                
                    <div class="form-group col-4">
                        <label for="codigo" class="text-white font-weight-bold">Código</label>
                        <input type="text" placeholder="Digite el código de versionamiento a imprimir en el informe" value="GFFO-01" name="codigo" id="codigo" class="input-sm mb-3 form-control">
                    </div>
                    <div class="form-group col-4">
                        <label for="version" class="text-white font-weight-bold">Versión</label>
                        <input type="number" placeholder="Digite la versión a imprimir en el informe" value="01" name="version" id="version" class="input-sm mb-3 form-control">
                    </div>
                    <div class="form-group col-4">
                        <label for="fechaVersion" class="text-white font-weight-bold">Fecha versión</label>
                        <input type="text" placeholder="Digite la fecha de la versión" value="08/10/2018" name="fechaVersion" id="fechaVersion" class="input-sm mb-3 form-control">
                    </div>                
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-block font-weight-bold p-2"><i class="fas fa-plus-circle"></i> GENERAR RETROALIMENTACION PDF</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Javascript Bootstrap -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/carga-pagina.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body> 
</html>