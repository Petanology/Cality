<!-- importaciones requeridas -->
<?php 
    require_once ("../modelo/tipoDocDao.php"); 
    require_once ("../controlador/sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    
    if($_SESSION['rol'] == "coord_financiera" || $_SESSION['rol'] == "coord_venta_directa" || $_SESSION['rol'] == "lider" || $_SESSION['rol'] == "asesor" || empty($_SESSION['autenticado'])){
        header("location:acceso_denegado.php");
    }
?>
        
    <!-- Mensaje de Registro / Actualización -->
    <?php include ("encabezado.php"); ?>
   
    <!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <form action="" method="post">
            <button type="submit" name="botonRegistrar" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_tipo_doc1"><i class="fas fa-plus"></i> REGISTRAR TIPO DE DOCUMENTO</button>
        </form>
        
        <!-- Lista de Tipos de Documentos -->
        <table class="table table-striped" id="tabla">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">
                        <img width="30" height="30" src="img/numeral.png" alt="icono de numeral">
                        <div class="mt-2">Número</div>
                    </th>
                    
                    <th class="text-center">
                        <img width="27" height="27" src="img/cedula.png" alt="">
                        <div class="mt-2">Tipo de documento</div>
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
                <form action="" method="post">
                    <?php
                        $objetoTDD = new tipoDocDao();
                        $ListarTabla = $objetoTDD->listarTabla();
                        foreach($ListarTabla as $rowLT):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowLT[0] ?></td>
                        <td class="text-center"><?php echo $rowLT[1] ?></td>
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
                
                foreach($listarItem as $rowLI){
                    include("modal/mModificarTipoDoc.php"); // Modal Modificar 
                }
            }
        ?>
    </div>
    
    <!-- Tablas dinámicas -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script>
        $(document).ready(function(){
            $('#tabla').DataTable();
        });
    </script>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Abrir modal Modificar si se dió clic en boton modificar -->
    <?php 
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_tipo_doc2').modal('show');</script>";
        }

        // Abrir modal Registrar si se dió clic en boton registrar
        if(isset($_POST['botonRegistrar'])){
            echo "<script>$('#form_tipo_doc1').modal('show');</script>";
        }
    ?>
</body> 
</html>