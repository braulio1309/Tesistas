<?php 

    function mostrarEspecialidad($db){
        $sql = "SELECT * FROM especialidades";
        //var_dump($db);die();
        $especialidad = mysqli_query($db, $sql);
        
        $resultado = array();
        if($especialidad && mysqli_num_rows($clientes) >= 1){
            $resultado = $especialidad;
        }
	
	    return $resultado;
    }
?>