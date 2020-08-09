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

    function mostrartrabajos($db){
        $sql = "SELECT 
                    t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato 
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = mysqli_query($db, $sql);
       
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function mostrarProfesores($db){
        $sql = "SELECT * FROM profesores";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }
?>