<!-- importaciones requeridas -->
<?php 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();

    if(empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }else if($_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "jefe_operaciones" || $_SESSION['rol'] == "lider"){
        header("location:acceso_denegado.php");
    }

    require_once ("../modelo/asesorDao.php");
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_asesor1"><i class="fas fa-plus"></i> REGISTRAR ASESOR</button>
        
        <form name="formularioModificar" action="" method="post">
        <!-- Lista de asesores -->
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
                        <img width="27" height="27" src="img/lider.png" alt="icono líder">
                        <div class="mt-2">Líder</div>
                    </th>             
                    <th class="text-center">
                        <img width="25" height="25" src="img/usuario.png" alt="icono usuario">
                        <div class="mt-2">Usuario</div>
                    </th>
                    <th class="text-center">
                        <img width="25" height="25" src="img/calendar.png" alt="icono usuario">
                        <div class="mt-2">Fecha Ingreso</div>
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
                        $objetoAD = new asesorDao();
                        $ListarTabla = $objetoAD->listarTabla();
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0] ?></td>
                        <td><?php echo $rowA[1] ?></td>
                        <td><?php echo $rowA[2] ?></td>
                        <td><?php echo $rowA[3] ?></td>
                        <td><?php echo $rowA[4] ?></td>
                        <td><?php echo $rowA[5] ?></td>
                        <td><?php echo $rowA[6] ?></td>
                        <td class="text-center"><?php if($rowA[7]): echo "<h5><span class='p-2 badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='p-2 badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]?>"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table> 
        </form>
        
        <?php
            include("modal/mRegistrarAsesor.php"); // Modal Registrar
            if(isset($_POST['botonModificar'])): // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoA = new asesorDao(); 
                $listarAsesor = $objetoA->listarItem($IdbotonModificar);
                
                foreach($listarAsesor as $rowA):
                    include("modal/mModificarAsesor.php"); // Modal Modificar 
                endforeach;
            endif;
        ?>
    </div>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php 
        // Abrir modal Modificar si se dió clic en boton modificar
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_asesor2').modal('show');</script>";
        }
    ?>    
    <script src="js/customFile.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/ejecutarDataTable.js"></script>
</body> 
</html>














