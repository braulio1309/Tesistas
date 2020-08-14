<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM profesores WHERE cedula_profe = '$id'";
	$eliminar = pg_Exec($db, $sql);


    header("Location:Mostrar_p.php")


?>




