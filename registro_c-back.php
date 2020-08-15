<?php
require_once 'includes/conexion.php';
    $id = $_GET['id'];
    $criterio = $_POST['criterio'];

    $sql = "SELECT * FROM formatos WHERE id_formato = '$id'";
    $criterios = pg_Exec($db, $sql);


    if(pg_result($criterios,0,2) == 'tutor_tig'){
        $sql="INSERT INTO  criterios_tutor_tig
            (id_formato, criterios) 
        VALUES
            ($id, '$criterio')";
        $formato = pg_Exec($db,$sql);
        
    }else
        if(pg_result($criterios,0,2) == 'tutor_teg'){

            $sql="INSERT INTO  criterios_tutor_teg
                (id_formato, criterios) 
            VALUES
                ($id, '$criterio')";
               // var_dump($sql);die();
            $formato = pg_Exec($db,$sql);

        }else
            if(pg_result($criterios,0,2) == 'revisor_tig'){

                $sql="INSERT INTO  criterios_revisor_tig
                            (id_formato, criterios) 
                        VALUES
                            ($id, '$criterio')";
                $formato = pg_Exec($db,$sql);

            }else
                if(pg_result($criterios,0,2) == 'revisor_teg'){

                    $sql="INSERT INTO  criterios_revisor_teg
                                (id_formato, criterios) 
                            VALUES
                                ($id, '$criterio')";
                    $formato = pg_Exec($db,$sql);

                }else
                    if(pg_result($criterios,0,2) == 'jurado_tig'){

                        $sql="INSERT INTO  criterios_jurado_tig
                                    (id_formato, criterios) 
                                VALUES
                                    ($id, '$criterio')";
                        $formato = pg_Exec($db,$sql);
                        //var_dump($sql);die();

                    }else
                        if(pg_result($criterios,0,2) == 'jurado_teg'){

                            $sql="INSERT INTO  criterios_jurado_teg
                                        (id_formato, criterios) 
                                    VALUES
                                        ($id, '$criterio')";
                                //var_dump($sql);die();

                            $formato = pg_Exec($db,$sql);

                        }
            
            header("Location:Mostrar_f.php");
