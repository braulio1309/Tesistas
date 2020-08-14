<?php
require_once 'includes/conexion.php';
    $id = $_GET['id'];
    $criterio = $_POST['criterio'];

    $sql = "SELECT * FROM formatos WHERE id_formato = '$id'";
    $criterios = pg_Exec($db, $sql);

    $resultado = array();
    $resultado = $criterios;
    $resultado = mysqli_fetch_assoc($resultado);
    //

    if($resultado['tipo_formato'] == 'tutor_tig'){
        $sql="INSERT INTO  criterios_tutor_tig
            (id_formato, criterio) 
        VALUES
            ($id, '$criterio')";
        $formato = pg_Exec($db,$sql);
        
    }else
        if($resultado['tipo_formato'] == 'tutor_teg'){

            $sql="INSERT INTO  criterios_tutor_teg
                (id_formato, criterio) 
            VALUES
                ($id, '$criterio')";
            $formato = pg_Exec($db,$sql);

        }else
            if($resultado['tipo_formato'] == 'revisor_tig'){

                $sql="INSERT INTO  criterios_revisor_tig
                            (id_formato, criterio) 
                        VALUES
                            ($id, '$criterio')";
                $formato = pg_Exec($db,$sql);

            }else
                if($resultado['tipo_formato'] == 'revisor_teg'){

                    $sql="INSERT INTO  criterios_revisor_teg
                                (id_formato, criterio) 
                            VALUES
                                ($id, '$criterio')";
                    $formato = pg_Exec($db,$sql);

                }else
                    if($resultado['tipo_formato'] == 'jurado_tig'){

                        $sql="INSERT INTO  criterios_jurado_tig
                                    (id_formato, criterio) 
                                VALUES
                                    ($id, '$criterio')";
                        $formato = pg_Exec($db,$sql);
                        var_dump($sql);die();

                    }else
                        if($resultado['tipo_formato'] == 'jurado_teg'){

                            $sql="INSERT INTO  criterios_jurado_teg
                                        (id_formato, criterio) 
                                    VALUES
                                        ($id, '$criterio')";
                            $formato = pg_Exec($db,$sql);
                            var_dump($formato);die();

                        }
            $entradas = array();
            $entradas = $formato;
            header("Location:Mostrar_f.php");
