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
                    t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato, t.nroCorrelativo
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

    function PropuestasAprobadas($db){
        $sql = "SELECT * FROM propuestas  WHERE aprobacionComite = 'APROBADO'";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function PropuestasReprobadas($db){
        $sql = "SELECT * FROM propuestas  WHERE aprobacionComite = 'REPROBADO'";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function PropuestasPendientes($db){
        $sql = "SELECT * FROM propuestas WHERE aprobacionComite IS NULL OR aprobacionComite = 'PENDIENTE'";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function PropuestaInstrumental($db){
        $sql = "SELECT * FROM propuestas WHERE tipo_propuesta = 'Ins'";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function PropuestaExperimental($db){
        $sql = "SELECT * FROM propuestas WHERE tipo_propuesta = 'Exp'";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function TrabajosExperimental($db){
        $sql = "SELECT 
                    t.id_tg, t.nroCorrelativo, t.nroConsejo, p.titulo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    p.tipo_propuesta = 'Exp' AND
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function TrabajosInstrumental($db){
        $sql = "SELECT 
                    t.id_tg, t.nroCorrelativo, t.nroConsejo, p.titulo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    p.tipo_propuesta = 'Ins' AND
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function formatos($db){
        $sql = "SELECT * FROM formatos";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function tutorFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_tutor_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function tutorFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_tutor_teg ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function revisorFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_revisor_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function revisorFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_revisor_teg ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    
    function juradoFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_jurado_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    function juradoFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_jurado_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = mysqli_query($db, $sql);
        
        $resultado = array();
        if($propuestas && mysqli_num_rows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    
?>