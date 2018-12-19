<!-- importaciones requeridas -->
<?php 
    require_once ("../modelo/valSeccDao.php");
    require_once ("../controlador/zonaHoraria.php");
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "lider" || $_SESSION['rol'] == "asesor" || empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid pt-3">
        
        <form action="" method="post">
        
        <!-- DIRECTO COMERCIAL -->
        <div class="p-2 bg-dark border border-secondary">
        <h1 class="pt-1 h6 text-center text-white font-weight-bold pb-2">GRUPO VENTA DIRECTA</h1>
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
                        $ListarTabla = $objetoAD->listarTabla(1,4);
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
                        $ListarTabla = $objetoAD->listarTabla(5,8);
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
                        $ListarTabla = $objetoAD->listarTabla(9,11);
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
        
        <!-- DIRECTO IN BOUND -->
        <table class="table table-secondary table-striped table-borderless scroll_modificado">
            <thead class="bg-secondary">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO ESTÁNDAR INBOUND</td>
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
                        $ListarTabla = $objetoAD->listarTabla(12,14);
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
        </div>
        <hr>
        
        <!-- NEGOCIACIÓN -->
        <div class="p-2 bg-dark border border-secondary mb-3">
        <h1 class="pt-1 h6 text-center text-white font-weight-bold pb-2">GRUPO FINANCIERO</h1>
        <table class="table table-secondary table-striped table-borderless scroll_modificado">
            <thead class="bg-info">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO NEGOCIACIÓN</td>
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
                        $ListarTabla = $objetoAD->listarTabla(15,19);
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
        
        <!-- MENSAJE -->
        <table class="table table-secondary table-striped table-borderless scroll_modificado">
            <thead class="bg-info">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO MENSAJE</td>
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
                        $ListarTabla = $objetoAD->listarTabla(20,22);
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
        
        <!-- FINANCIERO IN BOUND -->
        <table class="table table-secondary table-striped table-borderless scroll_modificado">
            <thead class="bg-info">
                <tr>
                    <td colspan="4" class="font-weight-bold text-center">FORMATO INBOUND</td>
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
                        $ListarTabla = $objetoAD->listarTabla(23,25);
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
        </div>
        </form>
        
        
        <?php
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