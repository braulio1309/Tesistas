<?php
    require_once 'includes/conexion.php';
    $parametro = $_POST["parametro"];

    if($parametro){
        $sql = "SELECT 
            * 
        FROM 
            propuestas 
        WHERE 
            num_correlativo = '$parametro' OR 
            titulo          LIKE '%$parametro%'";

        $propuestas = mysqli_query($db, $sql);
                
        $entradas = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $entradas = $propuestas;
        }
        require_once "resultado_pr.php";

    }else{
        header("Location:Mostrar_pr.php");
    }
?>