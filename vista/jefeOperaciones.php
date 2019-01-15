<!-- importaciones requeridas -->
<?php 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");    
    } else if($_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "lider" || $_SESSION['rol'] == "analista"){
        header("location:acceso_denegado.php");
    }

    require_once ("../modelo/jefeOperacionesDao.php"); 
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">
        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_jefe_operaciones1"><i class="fas fa-plus"></i> REGISTRAR JEFE DE OPERACIONES</button>
        
        <!-- Lista de jefe de operaciones  -->
        <form action="" method="post">
        <table id="tablaDinamica" class="table table-striped table-responsive-xl scroll_modificado">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">
                        <img width="30" height="30" src="img/numeral.png" alt="icono de numeral">
                        <div class="mt-2">Número</div>
                    </th>
                    <th class="text-center">
                        <img width="27" height="27" src="img/genero.png" alt="icono genero">
                        <div class="mt-2">Genero</div>
                    </th>                    
                    <th class="text-center">
                        <img width="32" height="32" src="img/cedula.png" alt="icono tipo documento">
                        <div class="mt-2">Tipo</div>
                    </th>
                    <th class="text-center">
                        <img width="29" height="29" src="img/personas.png" alt="icono personas">
                        <div class="mt-2">Nombre</div>
                    </th>
                    <th class="text-center">
                        <img width="25" height="25" src="img/correo.png" alt="icono genero">
                        <div class="mt-2">Correo</div>
                    </th>                    
                    <th class="text-center">
                        <img width="25" height="25" src="img/usuario.png" alt="icono usuario">
                        <div class="mt-2">Usuario</div>
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
                        $objetoAD = new jefeOperacionesDao();
                        $ListarTabla = $objetoAD->listarTabla();
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0] ?></td>
                        <td class="text-center"><?php echo $rowA[1] ?></td>
                        <td class="text-center"><?php echo $rowA[2] ?></td>
                        <td class="text-center"><?php echo $rowA[3] ?></td>
                        <td class="text-center"><?php echo $rowA[4] ?></td>
                        <td class="text-center"><?php echo $rowA[5] ?></td>
                        <td class="text-center"><?php if($rowA[6]): echo "<h5><span class='p-2 badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='p-2 badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]?>" data-toggle="modal" data-target="#form_jefe_operaciones2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table> 
        </form>
        
        <?php
            include("modal/mRegistrarJefeOperaciones.php"); // Modal Registrar
            if(isset($_POST['botonModificar'])): // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoA = new jefeOperacionesDao(); 
                $listarJefeOperaciones = $objetoA->listarItem($IdbotonModificar);
                
                foreach($listarJefeOperaciones as $rowA):
                    include("modal/mModificarJefeOperaciones.php"); // Modal Modificar 
                endforeach;
            endif;
        ?>
    </div>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/validacionContrasenas.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php 
        // Abrir modal Modificar si se dió clic en boton modificar
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_jefe_operaciones2').modal('show');</script>";
        }
    ?>
    <script src="js/customFile.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/ejecutarDataTable.js"></script>
</body> 
</html>












