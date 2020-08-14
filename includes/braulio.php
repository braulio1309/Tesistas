<?php 

    // CONSULTA PARA MOSTRAR TODAS LAS ESPECIALIDADES 
    function mostrarEspecialidad($db){
        $sql = "SELECT * FROM especialidades";
        $especialidad = pg_Exec($db, $sql);
        
        if($especialidad && pg_NumRows($especialidad) >= 1){
            $resultado = $especialidad;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA MOSTRAR TODAS LAS PROPUESTAS
    function mostrarPropuestas($db){
        $sql = "SELECT * FROM propuestas";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    // CONSULTA PARA MOSTRAR TODOS LOS TRABAJOS
    function mostrartrabajos($db){
        $sql = "SELECT 
                    t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion,  t.nroCorrelativo
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = pg_Exec($db, $sql);
       
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    // CONSULTA PARA MOSTRAR TODOS LOS PROFESORES
    function mostrarProfesores($db){
        $sql = "SELECT * FROM profesores";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    // CONSULTA PARA MOSTRAR TODAS LAS PROPUESTAS QUE HAN SIDO APROBADA
    function PropuestasAprobadas($db){
        $sql = "SELECT * FROM propuestas  WHERE aprobacionComite = 'APROBADO'";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    // CONSULTA PARA MOSTRAR TODAS LAS PROPUESTAS QUE HAN SIDO REPROBADA
    function PropuestasReprobadas($db){
        $sql = "SELECT * FROM propuestas  WHERE aprobacionComite = 'REPROBADO'";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    // CONSULTA PARA MOSTRAR TODAS LAS PROPUESTAS QUE ESTAN PENDIENTES O NULAS
    function PropuestasPendientes($db){
        $sql = "SELECT * FROM propuestas WHERE aprobacionComite IS NULL OR aprobacionComite = 'PENDIENTE'";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    //CONSULTA PARA OBTENER TODAS LAS PROPUESTA DE TIPO INSTRUMENTAL
    function PropuestaInstrumental($db){
        $sql = "SELECT * FROM propuestas WHERE tipo_propuesta = 'Ins'";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER TODAS LAS PROPUESTA DE TIPO EXPERIMENTAL
    function PropuestaExperimental($db){
        $sql = "SELECT * FROM propuestas WHERE tipo_propuesta = 'Exp'";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    // CONSULTA PARA OBTENER TODOS LOS TRABAJOS DE TIPO DE PROPUESTA EXPERIMENTAL
    function TrabajosExperimental($db){
        $sql = "SELECT 
                    t.id_tg, t.nroCorrelativo, t.nroConsejo, p.titulo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    p.tipo_propuesta = 'Exp' AND
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    // CONSULTA PARA OBTENER TODOS LOS TRABAJOS DE TIPO DE PROPUESTA INSTRUMENTAL
    function TrabajosInstrumental($db){
        $sql = "SELECT 
                    t.id_tg, t.nroCorrelativo, t.nroConsejo, p.titulo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    p.tipo_propuesta = 'Ins' AND
                    t.nroCorrelativo = p.num_correlativo";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    //CONSULTA PARA OBTENER TODOS LOS FORMATOS 
    function formatos($db){
        $sql = "SELECT * FROM formatos";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS TUTORES DE TIPO INSTRUMENTAL
    function tutorFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_tutor_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS TUTORES DE TIPO EXPERIMENTAL
    function tutorFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_tutor_teg ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS REVISORES DE TIPO INSTRUMENTAL
    function revisorFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_revisor_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS REVISORES DE TIPO EXPERIMENTAL
    function revisorFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_revisor_teg ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS JURADOS DE TIPO INSTRUMENTAL
    function juradoFormatoTig($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_jurado_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }

    //CONSULTA PARA OBTENER LOS FORMATOS DE LOS JURADOS DE TIPO EXPERIMENTAL
    function juradoFormatoTeg($db){
        $sql = "SELECT 
                    f.id_formato, f.nombre 
                FROM 
                    formatos f, formato_jurado_tig ft
                WHERE 
                    f.id_formato = ft.id_formato";
        $propuestas = pg_Exec($db, $sql);
        
        if($propuestas && pg_NumRows($propuestas) >= 1){
            $resultado = $propuestas;
        }
	
	    return $resultado;
    }


    
?>