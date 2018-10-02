<!-- importaciones requeridas -->
<?php require_once ("../modelo/valSeccDao.php"); ?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        
        <form action="" method="post">
        
        <!-- DIRECTO COMERCIAL -->
        <table class="table table-primary table-striped table-borderless scroll_modificado">
            <thead class="bg-primary">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO ETAPAS COMERCIALES VENTA DIRECTA</td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th>Valor</th>
                    <th>Porcentaje</th>
                    <th>Modificar</th>
                </tr>
            </thead>
               
            <tbody>
                    <?php
                        // se crea una instancia hacia el DAO
                        $objetoAD = new valSeccDao();
                        $ListarTabla = $objetoAD->listarTabla(1,3);
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0]; ?></td>
                        <td><?php echo $rowA[1]; ?></td>
                        <td><?php echo $rowA[2]; ?> %</td>
                        <td>
                        <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]; ?>" data-toggle="modal" data-target="#form_valSecc2"><i class="fas fa-pencil-alt"></i>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table> 
        
        <hr>
        
        <!-- DIRECTO PREJURIDICO -->        
        <table class="table table-danger table-striped table-borderless scroll_modificado">
            <thead class="bg-danger">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO ETAPAS PREJURIDICAS VENTA DIRECTA</td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th>Valor</th>
                    <th>Porcentaje</th>
                    <th>Modificar</th>
                </tr>
            </thead>
               
            <tbody>
                    <?php
                        // se crea una instancia hacia el DAO
                        $objetoAD = new valSeccDao();
                        $ListarTabla = $objetoAD->listarTabla(4,6);
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0]; ?></td>
                        <td><?php echo $rowA[1]; ?></td>
                        <td><?php echo $rowA[2]; ?> %</td>
                        <td>
                        <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]; ?>" data-toggle="modal" data-target="#form_valSecc2"><i class="fas fa-pencil-alt"></i>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
        
        <hr>
        
        <!-- DIRECTO ESTÁNDAR CONTACTO INDIRECTO -->
        <table class="table table-success table-striped table-borderless scroll_modificado">
            <thead class="bg-success">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO ESTÁNDAR CONTACTO INDIRECTO</td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th>Valor</th>
                    <th>Porcentaje</th>
                    <th>Modificar</th>
                </tr>
            </thead>
               
            <tbody>
                    <?php
                        // se crea una instancia hacia el DAO
                        $objetoAD = new valSeccDao();
                        $ListarTabla = $objetoAD->listarTabla(7,9);
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0]; ?></td>
                        <td><?php echo $rowA[1]; ?></td>
                        <td><?php echo $rowA[2]; ?> %</td>
                        <td>
                        <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]; ?>" data-toggle="modal" data-target="#form_valSecc2"><i class="fas fa-pencil-alt"></i>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table> 
        </form>
        
        <hr>
        
        <!-- DIRECTO IN BOUND -->
        <table class="table table-secondary table-striped table-borderless scroll_modificado">
            <thead class="bg-secondary">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO ESTÁNDAR IN BOUND</td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th>Valor</th>
                    <th>Porcentaje</th>
                    <th>Modificar</th>
                </tr>
            </thead>
               
            <tbody>
                <form action="" method="post">
                    <?php
                        // se crea una instancia hacia el DAO
                        $objetoAD = new valSeccDao();
                        $ListarTabla = $objetoAD->listarTabla(10,12);
                        foreach($ListarTabla as $rowA):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowA[0]; ?></td>
                        <td><?php echo $rowA[1]; ?></td>
                        <td><?php echo $rowA[2]; ?> %</td>
                        <td>
                        <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowA[0]; ?>" data-toggle="modal" data-target="#form_valSecc2"><i class="fas fa-pencil-alt"></i>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table>
        
        
        <?php
            include("modal/mRegistrarValSecc.php"); // Modal Registrar
            if(isset($_POST['botonModificar'])): // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoA = new valSeccDao(); 
                $listarValSecc = $objetoA->listarItem($IdbotonModificar);
                
                foreach($listarValSecc as $rowA):
                    include("modal/mModificarValSecc.php"); // Modal Modificar 
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
            echo "<script>$('#form_valSecc2').modal('show');</script>";
        }
    ?>
</body> 
</html>