<!-- Contenido -->  
    <div class="container-fluid">

        <!-- botón registrar -->
        <button type="button" class="mt-3 mb-3 btn btn-primary font-weight-bold" data-toggle="modal" data-target="#form_item1"><i class="fas fa-plus"></i> REGISTRAR <?php echo strtoupper($enunciado); ?></button>
        
        <!-- Lista de items directo comercial - negociación -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">
                        <img width="30" height="30" src="img/numeral.png" alt="icono de numeral">
                        <div class="mt-2">Número</div>
                    </th>                    
                    
                    
                    <th class="text-center">
                        <img width="30" height="30" src="img/nombre.png" alt="icono de título">
                        <div class="mt-2">Título</div>
                    </th>
                    <th class="text-center">
                        <img width="25" height="25" src="img/descripcion.png" alt="icono de descripción">
                        <div class="mt-2">Descripcion</div>
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
                        // se crea una instancia hacia el DAO
                        $objetoDao = new itemDao($nomTabla);
                    
                        $ListarTabla = $objetoDao->listarTabla();
                        foreach($ListarTabla as $rowLT):
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $rowLT[0] ?></td>
                        <td class="font-weight-bold"><?php echo $rowLT[1] ?></td>
                        <td class="text-justify"><?php echo $rowLT[2] ?></td>
                        <td class="text-center"><?php if($rowLT[3]): echo "<h5><span class='p-2 badge badge-primary'>Activo</span></h5>"; else: echo "<h5><span class='p-2 badge badge-danger'>Inactivo</span></h5>"; endif; ?></td>
                        <td class="text-center">
                            <button type="submit" name="botonModificar" class="btn btn-success" value="<?php echo $rowLT[0]?>" data-toggle="modal" data-target="#form_item2"><i class="fas fa-pencil-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table> 
        
        
        <?php
            include("modal/mRegistrarItem.php"); // Modal Registrar

            if(isset($_POST['botonModificar'])){ // traer informacón de item seleccionado
                $IdbotonModificar = $_POST['botonModificar'];
                $objetoTDD2 = new itemDao($nomTabla); 
                $listarItem = $objetoTDD2->listarItem($IdbotonModificar);
                
                foreach($listarItem as $rowLI):
                    include("modal/mModificarItem.php"); // Modal Modificar 
                endforeach;}      
        ?>
    </div>
    

    <!-- Javascript Bootstrap -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/carga-pagina.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/contarCaracteres.js"></script>
    <!-- Abrir modal Modificar si se dió clic en boton modificar -->
    <?php 
        if(isset($_POST['botonModificar'])){
            echo "<script>$('#form_item2').modal('show');</script>";
        }
    ?>
</body> 
</html>