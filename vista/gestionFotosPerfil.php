<!-- importaciones requeridas -->
<?php 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");    
    } else if($_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "lider" || $_SESSION['rol'] == "administrador"){
        header("location:acceso_denegado.php");
    }

    // require_once ("../modelo/gestionFotosPerfilDao.php"); 
    require_once ("../modelo/personaDao.php"); 
?>

<!-- Mensaje de Registro / Actualización -->
<?php include ("encabezado.php"); ?>


<!-- PRIMERA SECCION -->
<div class="p-3">
    <div class="container-fluid rounded bg-white border-primary text-dark border border-dark">
        <form action="" method="post" name="formBusqueda">
            <h6 class="pt-3 pb-2 font-weight-bold">Búsqueda de Personas</h6>
            <div class="form-group">
                <div class="input-group">
                    <input list="asesores-consulta" class="pl-3 pt-3 pb-3 form-control form-control-sm" name="personaConsulta" id="personaConsulta" placeholder="Seleccione o digite el asesor que desea gestionar" required>
                    <datalist id="asesores-consulta">
                        <?php
                                    $objetoPersona = new personaDao();
                                    $resultadoListaPM = $objetoPersona->listarPersonasMixtos();
                                    foreach ($resultadoListaPM as $rowPM){
                                ?>
                        <option>
                            <?php echo $rowPM[0]; ?>
                        </option>
                        <?php
                                    }
                                ?>
                    </datalist>
                    <div class="input-group-append">
                        <button type="submit" name="boton-consultar" class="btn btn-sm text-white" style="background:#E67E22"><i class="fas fa-search pl-4 pr-4"></i></button>
                    </div>
                </div>
                <small class="pt-2 pb-3 form-text"><i class="far fa-question-circle"></i>&nbsp; Tenga en cuenta que puede buscar la persona por medio de su nombre u identificación</small>
            </div>
        </form>
    </div>

    <?php if(isset($_POST['boton-consultar'])){
            $pIngresada = $_POST['personaConsulta'];
            $objetoPersona2 = new personaDao();
            $oPersona2 = $objetoPersona2->listarPersonaFoto($pIngresada);
    
    ?>
        <div class="card-columns">
            <?php foreach($oPersona2 as $rowOPersona2){ ?>
            <div class="card">
                <?php
                if($rowOPersona2[3] != "") {
                ?>
                    <img src="<?php echo $rowOPersona2[3] ?>" class="card-img-top p-3" alt="Imagen de pefil">
                <?php
                }else {
                    if($rowOPersona2[4] == 1){
                ?>
                    <img src="img/user-man.png" class="card-img-top p-5" alt="Imagen de pefil">          
                <?php      
                    } else if ($rowOPersona2[4] == 2){
                ?>
                    <img src="img/user-woman.png" class="card-img-top p-5" alt="Imagen de pefil">            
                <?php   
                    } else {
                ?>
                    <img src="img/photo-camera.png" class="card-img-top p-5" alt="Imagen de pefil">            
                <?php      
                    }
                }
                ?>      
                <div class="card-body">
                    <h5 class="card-title"><?php echo $rowOPersona2[0] ?></h5>
                    <p class="card-text">Identificado con <?php echo $rowOPersona2[1] ?> # <?php echo $rowOPersona2[2] ?></p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } else { ?>
    <!-- SI NO SE HA BUSCADO NADA -->
    <div class="container-fluid w-75 text-center">
        <img src="img/portrait.png" width="120" class="m-5 p-2" alt="icono de búsqueda">
        <h2 class="h3 text-white mt-2">Aquí visualizará la <kbd>foto de perfil</kbd> del usuario consultado</h2>
    </div>
    <?php } ?>

</div>

<!-- Javascript Bootstrap -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/carga-pagina.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>


<!--
FORMA DE BORRAR ARCHIVO

//eliminando de la bd 
$cod=$_POST["cod"]; 
mysql_query("DELETE FROM maquina WHERE codigo='$cod' ")or die(mysql_error());  

//eliminando del servidor 
unlink($directorio.$foto);//sabiendo que estos son los parametros para tu caso 
-->
