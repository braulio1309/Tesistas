<?php 

    $id = $_GET['id'];
    $sql = "SELECT 
                pr.num_correlativo, p.nombreProfe, p.direccionProfe, p.cedulaProfe, p.correoProfe, pr.titulo, pr.tipo_propuesta, tr.nroConsejo
            FROM 
                profesores p, propuestas pr, trabajos tr
            WHERE 
                pr.cedula_profe = p.profe AND
                tr.nroCorrelativo = pr.num_correlativo AND
                tr.id_tg = $id";
    $trabajo = pg_Exec($db, $sql);

    $correlativo = pg_result($trabajo, 0, 0);

    $sql1 = "SELECT 
                t.nombre, t.cedula, t.telefono, t.correo_part, t.correo_ucab
            FROM 
               presentan pr, tesistas t
            WHERE 
                t.cedulaTesista = pr.cedula AND
                pr.nroCorrelativo= $correlativo";
    $tesistas = pg_Exec($db, $sql1);   