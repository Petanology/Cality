<!-- importaciones requeridas -->
<?php 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    } else if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "lider"){
        header("location:acceso_denegado.php");
    }

    require_once ("../modelo/errorCriticoDao.php");
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <form action="" method="post">
            <button type="submit" name="botonRegistrar" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_error_critico1"><i class="fas fa-plus"></i> REGISTRAR ERROR CRITICO</button>
        </form>
        
        <!-- Lista de error critico -->
        <form action="" method="post">
        <table id="tablaDinamica" class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">
                        <img width="30" height="30" src="img/numeral.png" alt="icono de numeral">
                        <div class="mt-2">Número</div>
                    </th>                    
                    <th>
                        <img width="25" height="25" src="img/error.png" alt="icono de error">
                        <div class="mt-2">Error crítico</div>
                    </th>                    
                    <th class="text-center">
                        <img width="24" height="24" src="img/interruptor.png" alt="icono swicth">
                        <div class="mt-2">Estado</div>
                    </th>
                    <th class="text-center">
                        <img width="25" height="25" src="img/actualizar.png" alt="icono de actualizar">
                        <div class="mt-2">Modificar</div>
                    </th>
                </tr>
            </thead>
               
            <tbody class="table-light">
                    <?php
                        // se crea una instancia hacia el DAO
                        $objetoTDD = new errorCriticoDao();
                    
                        $ListarTabla = $objetoTDD->listarTabla();
                        foreach($ListarTabla as $rowLT):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowLT[0] ?></td>
                        <td class="text-justify"><?php echo $rowLT[1] ?></td>
                        <td class="text-center"><?php if($rowLT[2]): echo "<h5><span class=' p-2 badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='p-2 badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowLT[0]?>" data-toggle="modal" data-target="#form_error_critico2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table> 
        </form>
        
        
        <?php
            include("modal/mRegistrarErrorCritico.php"); // Modal Registrar

            if(isset($_POST['botonModificar'])){ // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoTDD2 = new errorCriticoDao(); 
                $listarItem = $objetoTDD2->listarItem($IdbotonModificar);
                
                foreach($listarItem as $rowLI):
                    include("modal/mModificarErrorCritico.php"); // Modal Modificar 
                endforeach;}      
        ?>
    </div>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Abrir modal Modificar si se dió clic en boton modificar -->
    <?php 
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_error_critico2').modal('show');</script>";
        }

        // Abrir modal Registrar si se dió clic en boton registrar
        if(isset($_POST['botonRegistrar'])){
            echo "<script>$('#form_error_critico1').modal('show');</script>";
        }
    ?>
    <script src="js/datatables.min.js"></script>
    <script src="js/ejecutarDataTable.js"></script>
</body> 
</html>