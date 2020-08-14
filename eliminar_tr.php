<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];
    $sql = "DELETE FROM trabajos WHERE id_tg = '$id'";
	$eliminar = pg_Exec($db, $sql);


    header("Location:Mostrar_pr.php")


?>




