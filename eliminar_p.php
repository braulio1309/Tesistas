<?php

    require_once 'includes/conexion.php';
    $id=$_GET["id"];

    $sql = "SELECT * FROM internos  WHERE cedula_profe = '$id'";
    $busca = pg_Exec($db, $sql);

    $sql = "SELECT * FROM externos  WHERE cedula_profe = '$id'";
    $busca2 = pg_Exec($db, $sql);

    if(pg_numRows($busca2)>0){
        $sql = "DELETE FROM externos WHERE cedula_profe = '$id'";
        $eliminar = pg_Exec($db, $sql);
    }else{
        $sql = "DELETE FROM internos WHERE cedula_profe = '$id'";
        $eliminar = pg_Exec($db, $sql);
    }
    $sql = "DELETE FROM profesores WHERE cedula_profe = '$id'";
    $eliminar = pg_Exec($db, $sql);

   


    header("Location:Mostrar_p.php")


?>




