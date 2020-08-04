<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM especialidades WHERE id_especialidad = '$id'";
	$eliminar = mysqli_query($db, $sql);

    header("Location:Mostrar_t.php")


?>




