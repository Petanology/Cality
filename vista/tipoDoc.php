<!-- importaciones requeridas -->
<?php require_once ("../modelo/tipoDocDao.php"); ?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_tipo_doc1"><i class="fas fa-plus"></i> REGISTRAR TIPO DE DOCUMENTO</button>
        
        <!-- Lista de Tipos de Documentos -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th>Nombre</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Modificar</th>
                </tr>
            </thead>
               
            <tbody class="table-light">
                <form action="" method="post">
                    <?php
                        $objetoTDD = new tipoDocDao();
                        $ListarTabla = $objetoTDD->listarTabla();
                        foreach($ListarTabla as $rowLT):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowLT[0] ?></td>
                        <td><?php echo $rowLT[1] ?></td>
                        <td class="text-center"><?php if($rowLT[2]): echo "<h5><span class='p-2 badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='p-2 badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowLT[0]?>" data-toggle="modal" data-target="#form_tipo_doc2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table> 
        
        
        <?php
            include("modal/mRegistrarTipoDoc.php"); // Modal Registrar

            if(isset($_POST['botonModificar'])){ // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoTDD2 = new tipoDocDao(); 
                $listarItem = $objetoTDD2->listarItem($IdbotonModificar);
                
                foreach($listarItem as $rowLI):
                    include("modal/mModificarTipoDoc.php"); // Modal Modificar 
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
            echo "<script>$('#form_tipo_doc2').modal('show');</script>";
        }
    ?>
</body> 
</html>