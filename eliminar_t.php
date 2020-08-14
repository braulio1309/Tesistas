<?php

    require_once 'includes/conexion.php';
    $cedula=$_GET["cedula"];
    $sql = "DELETE FROM tesistas WHERE cedula = '$cedula'";
	$eliminar = pg_Exec($db, $sql);

    header("Location:Mostrar_t.php")


?>




