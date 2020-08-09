<?php
require_once 'includes/conexion.php';

    $id_tg = $_POST['id'];
    $cedula = $_POST['cedula'];
    $sql = "SELECT 
                * 
            FROM 
                es_jurado 
            WHERE 
                id_tg = $id_tg";
    $jurados = mysqli_query($db, $sql);
    //var_dump($jurados);die();

    if(mysqli_num_rows($jurados) <1){
        $sql = "INSERT 
                INTO 
                    es_jurado(id_tg, jurado_profe1) 
                VALUES 
                    ('$id_tg', $cedula )";
        $jurados = mysqli_query($db, $sql);
    }else{
        $resultado = array();
	    $resultado = $jurados;
        $resultado = mysqli_fetch_assoc($jurados);
        
        if($resultado['jurado_profe2'] == null){
            //die();
            $sql = "UPDATE es_jurado
				SET 
					jurado_profe2 = '$cedula'
				WHERE 
					id_tg = '$id_tg'; ";
            $update = mysqli_query($db,$sql);
            //var_dump($sql);die();
        }else 
            if($resultado['jurado_profe3'] == null){
                $sql = "UPDATE es_jurado
				SET 
					jurado_profe3 = $cedula
				WHERE 
					id_tg = '$id_tg'; ";
		        $update = mysqli_query($db,$sql);
            }else{
                $sql = "UPDATE es_jurado
				SET 
					jurado_profe4 = $cedula
				WHERE 
					id_tg = '$id_tg'; ";
		        $update = mysqli_query($db,$sql);
            }
        

    }
    header("Location:Mostrar_tr.php");