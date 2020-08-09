<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
    require_once 'includes/conexion.php';
	$id = $_GET["id"];
		
    $sql = "SELECT 
                t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato 
            FROM 
                trabajos t, propuestas p 
            WHERE 
                t.nroCorrelativo = p.num_correlativo AND
                t.id_tg = '$id'";
    $propuestas = mysqli_query($db, $sql);

    $resultado = array();
	$resultado = $propuestas;
	$resultado = mysqli_fetch_assoc($resultado);

    if (isset($_POST["at"])){
		$nombre = $_POST["nombre"];
		$sql="UPDATE especialidades SET (nombreEspecialidad ='$nombre' WHERE id_especialidad='$id')";
		$final=mysqli_query($db,$sql);

		if($final==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}

	}

?>

<div class="container">
		<h1>Actualización de trabajo</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Cédula del tesista 1</label>
						<input type="text"  autofocus name="cedula1" class="form-control" id="cedula" readonly>
					</div>

                    <div class="form-group">
						<label for="" src="cedula">Cédula del tesista 2</label>
						<input type="text" autofocus name="cedula2" class="form-control" id="cedula" readonly>
					</div>

					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" value="<?= $resultado['titulo']?>" readonly>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label>Número de consejo</label>
							<input type="number" class="form-control"  value="<?=$resultado['nroConsejo']?>" readonly>
						</div>
                    </div>

					<div class="row">
						<div class="col-sm-12">
							<label>Formato de evaluación</label>
							<input type="text" class="form-control"  value="<?=$resultado['tipo_formato']?>" readonly>
						</div>
                        
                    </div>

					<div class="row">
						<div class="col-sm-6">
							<label>Fecha de presentación</label>
							<input type="date" class="form-control" value="<?=$resultado['f_entrega_esc']?>" >
						</div>
						<div class="col-sm-6">
							<label>Hora presentación</label>
							<input type="time" class="form-control" value="<?=$resultado['f_presentacion_comite']?>">
						</div>
						
					</div>
                
<br>
					
					<div class="form-group">					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Actualizar trabajo">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->