<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM especialidades WHERE id = '$id'";
	$eliminar = mysqli_query($db, $sql);

    header("Location:Mostrar_t.php")


?>




