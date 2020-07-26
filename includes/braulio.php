<?php 

    function mostrarEspecialidad($db){
        $sql = "SELECT * FROM especialidades";
        $especialidad = mysqli_query($db, $sql);
        
        $resultado = array();
        if($especialidad && mysqli_num_rows($especialidad) >= 1){
            $resultado = $especialidad;
        }
	
	    return $resultado;
    }

    function mostrarPropuestas($db){
        $sql = "SELECT * FROM propuestas";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }
?>