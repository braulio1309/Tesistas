<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
    require_once 'includes/conexion.php';
	$id = isset($_GET["id"]) ? $_GET["id"]: null;
	$num_correlativo = isset($_GET["num_correlativo"]) ? $_GET["num_correlativo"]: null;
		
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
	
	$sql = "SELECT 
				t.nombre 
			FROM 
				presentan p, tesistas t 
			WHERE 
				p.nroCorrelativo = '$num_correlativo' AND
				p.cedulaTesista = t.cedula";
	$tesista = mysqli_query($db,$sql);
	$tesistas = array();
	$tesistas = $tesista;
    if (isset($_POST["at"])){
		$id = $_POST['id'];
		$consejo = isset($_POST["consejo"])?$_POST['consejo']:null;
		$fecha   = !empty($_POST['fecha'])?$_POST['fecha']:null;
		$hora 	 = !empty($_POST['hora'])?$_POST['hora']:null;
		$fechaApro 	 = !empty($_POST['fechaApro'])?$_POST['fechaApro']:null;


		$sql="UPDATE 
				trabajos 
			 SET 
			 	nroConsejo = $consejo, Fecha_presentacion ='$fecha', horaPresentacion = '$hora', fechaAprobacion = '$fechaApro'
			WHERE id_tg='$id'";
		//var_dump($sql);die(); //Error

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
				<?php 
                                
					while($tesi = mysqli_fetch_assoc($tesistas)):
				?>
					<div class="form-group">
						<label  src="cedula">Autor</label>
						<input type="text"  class="form-control" value="<?=$tesi['nombre']?>" readonly>
						<input type="hidden" name="id" class="form-control" value="<?=$resultado['id_tg']?>" readonly>

					</div>
				<?php
					endwhile;
				?>
					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" value="<?=$resultado['titulo']?>" readonly>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label>Número de consejo</label>
							<input type="number" name="consejo" class="form-control"  value="<?=$resultado['nroConsejo']?>" >
						</div>
                    </div>


					<div class="row">
						<div class="col-sm-4">
							<label>Fecha de presentación</label>
							<input type="date" name="fecha" class="form-control" value="<?=$resultado['Fecha_presentacion']?>" >
						</div>
						<div class="col-sm-4">
							<label>Hora presentación</label>
							<input type="time" name="hora" class="form-control" value="<?=$resultado['horaPresentacion']?>">
						</div>

						<div class="col-sm-4">
							<label>Fecha aprobación</label>
							<input type="date" name="fechaApro" class="form-control" value="<?=$resultado['fechaAprobacion']?>">
						</div>

					</div>
                
<br>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">					
								<input type="submit" class="btn btn-primary" name="at" id="at" value="Actualizar trabajo">
							</div>
						</div>
						
						<div class="col-sm-6">
							<a class="btn btn-success" href="mostrar_j?id=<?=$resultado['id_tg']?>" >Ver Jurados</a>
						</div>
					</div>
					
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->