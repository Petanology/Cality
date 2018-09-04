<?php
    require_once ("sesiones.php");
    $sss = new sesiones();
    $sss->iniciar();
    $sss->destruir();
    header("location: ../vista/index.php");
?>