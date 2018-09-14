<!-- importaciones requeridas -->
<?php require_once ("../modelo/tipoDocDao.php"); ?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_tipo_doc1"><i class="fas fa-plus"></i> REGISTRAR</button>
        
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
                        $consultaLT = tipoDocDao::listarTabla();
                        foreach($consultaLT as $rowLT):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowLT[0] ?></td>
                        <td><?php echo $rowLT[1] ?></td>
                        <td class="text-center"><?php if($rowLT[2]): echo "<h5><span class='badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowLT[0]?>" data-toggle="modal" data-target="#form_tipo_doc2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </form>
            </tbody>
        </table> 
        
        
        <!-- Modal Registrar-->
        <div class="modal fade" id="form_tipo_doc1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Tipo Documento</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controlador/tipoDocControlador.php" method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="mb-3 form-control" id="nombre" name="nombre" placeholder="Digite el nuevo tipo de documento">
                                <button type="submit" value="REGISTRAR" name="boton" class="btn btn-success">REGISTRAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    


        <!-- traer informacón de item seleccionado -->    
        <?php
            if(isset($_POST['botonModificar'])){
                $IdbotonModificar = $_POST['botonModificar'];
                $consultaLI = tipoDocDao::listarItem($IdbotonModificar);
                foreach($consultaLI as $rowLI):
        ?>
        

        <!-- Modal Modificar -->
        <div class="modal fade" id="form_tipo_doc2" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Tipo Documento</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="../controlador/tipoDocControlador.php" method="post">
                    <div class="modal-body">
                            <div class="form-group">

                                <!-- Identificación -->
                                <div class="form-group">
                                    <label for="id2">Identificación</label>
                                    <input type="text" value="<?php echo $rowLI[0]; ?>" class="form-control" id="id2" name="id2" placeholder="Aquí debe visualizar la identificación" readonly>
                                    <small class="form-text text-muted"><i class="far fa-question-circle"></i>&nbsp; Recuerde que la identificación no se puede modificar</small>
                                </div>

                                <!-- Nombre -->
                                <div class="form-group">
                                    <label for="nombre2">Nombre</label>
                                    <input type="text" value="<?php echo $rowLI[1]; ?>" class="form-control" id="nombre2" name="nombre2" placeholder="Digite el nuevo tipo de documento">
                                </div>

                                <!-- Estado -->
                                <div class="form-group">
                                    <label for="estado2">Estado</label>
                                    <select name="estado2" id="estado2" class="form-control">
                                        <option value="" disabled>Seleccione el estado</option>
                                        <option value="1" <?php if($rowLI[2]==1){ echo "selected"; } ?>>Activo</option>
                                        <option value="0" <?php if($rowLI[2]==0){ echo "selected"; } ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                        <div class="modal-footer">
                            <button type="submit" value="MODIFICAR" name="boton" class="btn btn-success">MODIFICAR</button>
                            <button type="button" name="boton" data-dismiss="modal" class="btn btn-secondary">CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        
        <?php endforeach;} ?>

    </div>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Abrir modal Modificar si se dió clic en boton modificar -->
    <?php 
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_tipo_doc2').modal('show');</script>";
        };
    ?>
</body>
</html>