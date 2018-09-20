<!-- importaciones requeridas -->
<?php require_once ("../modelo/asesorDao.php"); ?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_asesor1"><i class="fas fa-plus"></i> REGISTRAR ASESOR</button>
        
        <!-- Lista de asesores -->
        <table class="table table-striped table-responsive-xl scroll_modificado">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Genero</th>
                    <th class="text-center">Clase</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Líder</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Modificar</th>
                </tr>
            </thead>
               
            <tbody class="table-light">
                <form action="" method="post">
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
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]?>" data-toggle="modal" data-target="#form_asesor2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table> 
        
        <?php
            include("modal/mRegistrarAsesor.php"); // Modal Registrar

            if(isset($_POST['botonModificar'])){ // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoA = new asesorDao(); 
                $listarAsesor = $objetoA->listarItem($IdbotonModificar);
                
                foreach($listarAsesor as $rowA):
                    include("modal/mModificarAsesor.php"); // Modal Modificar 
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
            echo "<script>$('#form_asesor2').modal('show');</script>";
        }
    ?>
</body> 
</html>