<?php require_once 'includes/conexion.php';

 
	if (isset($_POST["rt"])){
    //Recibimos todos los valores
		$nombre = isset($_POST["nombre"]) ? $_POST["nombre"]: null;
		$tipo = isset($_POST["tipo"]) ? $_POST["tipo"]: null;


        $sql="INSERT INTO 
                    formatos(nombre, tipo_formato) 
            VALUES 
                ('$nombre', '$tipo')";
        $formato = mysqli_query($db,$sql);
        $sql = "SELECT 
                    id_formato 
                FROM 
                    formatos 
                ORDER BY 
                    id_formato DESC";
        $formato = mysqli_query($db,$sql);

        $resultado = array();
        $resultado = $formato;
        $resultado = mysqli_fetch_assoc($resultado);
        $id = $resultado['id_formato'];

        if($tipo == 'tutor_tig'){
            $sql="INSERT INTO 
                formato_tutor_tig(id_formato) 
            VALUES 
                ('$id')";
            $formato = mysqli_query($db,$sql);
            

        }else
            if($tipo == 'tutor_teg'){

                $sql="INSERT INTO 
                    formato_tutor_teg(id_formato) 
                VALUES 
                    ('$id')";
                $formato = mysqli_query($db,$sql);

            }else
                if($tipo == 'revisor_tig'){

                    $sql="INSERT INTO 
                        formato_revisor_tig(id_formato) 
                    VALUES 
                        ('$id')";
                    $formato = mysqli_query($db,$sql);

                }else
                    if($tipo == 'revisor_teg'){

                        $sql="INSERT INTO 
                            formato_revisor_teg(id_formato) 
                        VALUES 
                            ('$id')";
                        $formato = mysqli_query($db,$sql);

                    }else
                        if($tipo == 'jurado_tig'){

                            $sql="INSERT INTO 
                                formato_jurado_tig(id_formato) 
                            VALUES 
                                ('$id')";
                            $formato = mysqli_query($db,$sql);

                        }else
                            if($tipo == 'jurado_teg'){

                                $sql="INSERT INTO 
                                    formato_jurado_teg(id_formato) 
                                VALUES 
                                    ('$id')";
                                $formato = mysqli_query($db,$sql);
                            }
        header("Location:Mostrar_t.php");

    }

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>REGISTRO DE FORMATO</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">

					<div class="form-group">
						<label for="" src="nombre">Nombre Formato</label>
						<input type="text" name="nombre" class="form-control" id="nombre">
					</div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="" src="cedula">Profesor revisor</label>
                            <select class="form-control" name="tipo">
                                <option value="tutor_tig">Tutor tig</option>
                                <option value="tutor_teg">Tutor teg</option>
                                <option value="revisor_tig">Revisor tig</option>
                                <option value="revisor_teg">Revisor teg</option>
                                <option value="jurado_tig">Jurado tig</option>
                                <option value="jurado_teg">Jurado teg</option>
                            </select>
                        </div>
                    </div>
          
                   
                    
<br>
                   
					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar Formato">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

	
<?php require_once 'includes/pie.php'; ?>