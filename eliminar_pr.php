<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM propuestas WHERE num_correlativo = '$id'";
	$eliminar = mysqli_query($db, $sql);


    header("Location:Mostrar_pr.php")


?>




