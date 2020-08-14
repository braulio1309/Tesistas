<?php
    require_once 'includes/conexion.php';
    $parametro = $_POST["parametro"];

    if($parametro){
        $sql = "SELECT 
            * 
        FROM 
            especialidades 
        WHERE 
            id_especialidad = '$parametro' OR 
            nombreEspecialidad   LIKE '%$parametro%'";

        $propuestas = pg_Exec($db, $sql);
                
        $entradas = array();
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $entradas = $propuestas;
        }
        require_once "resultado_e.php";

    }else{
        header("Location:Mostrar_e.php");
    }
?>