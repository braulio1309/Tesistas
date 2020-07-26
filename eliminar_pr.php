<?php

    require_once 'includes/conexion.php';
    $cedula=$_GET["id"];
    $sql = "DELETE FROM propuestas WHERE id = '$id'";
	$eliminar = mysqli_query($db, $sql);

    header("Location:Mostrar_pr.php")


?>




