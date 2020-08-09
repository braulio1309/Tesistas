<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM trabajos WHERE id_tg = '$id'";
	$eliminar = mysqli_query($db, $sql);


    header("Location:Mostrar_pr.php")


?>




