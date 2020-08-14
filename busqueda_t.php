<?php
    require_once 'includes/conexion.php';
    $parametro = $_POST["parametro"];

    if($parametro){
        $sql = "SELECT 
            * 
        FROM 
            tesistas 
        WHERE 
            cedula LIKE '%$parametro%' OR 
            nombre LIKE '%$parametro%' OR
            correo_ucab LIKE '%$parametro%' OR 
            correo_part LIKE '%$parametro%' OR 
            sexo LIKE '%$parametro%'";

        $propuestas = pg_Exec($db, $sql);
                
        $entradas = array();
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $entradas = $propuestas;
        }
        require_once "resultado_t.php";

    }else{
        header("Location:Mostrar_t.php");
    }
?>