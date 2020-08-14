<?php require_once 'includes/cabecera.php'; ?>
<?php
    require_once 'includes/conexion.php';
    $id = isset($_GET['id'])?$_GET['id']:null;
	
	if($id){
		$sql="SELECT * FROM especialidades WHERE id_especialidad = '$id' ";
		$especidalidad = pg_Exec($db,$sql);
	
		$resultado = array();
		$resultado = $especidalidad;
		$resultado = mysqli_fetch_assoc($resultado);
	}
    
	// SI PRESIONAN ACTUALIZAR DATOS LOS DATOS INTRODUCIDOS SE GUARDAN EN UNA VARIABLE.
    if (isset($_POST["at"])){
		$nombre = $_POST["nombre"];
		$id = $_POST["id"];

		// ACTUALIZA DATOS DE LA ESPECIALIDADES
		$sql="UPDATE 
				especialidades 
			SET 
				nombreEspecialidad ='$nombre' 
			WHERE 
				id_especialidad='$id'";
				
		$final=pg_Exec($db,$sql);
		
		if($final==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_e.php");
		}

	}

?>

<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>REGISTRO DE ESPECIALIDAD</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Nombre de la especialidad</label>
						<input type="text" autofocus name="nombre" class="form-control" id="cedula" value="<?=$resultado['nombreEspecialidad'] ?>">
					</div>
					<input type="hidden" class="btn btn-primary" name="id" id="rt" value="<?=$resultado['id_especialidad']?>">

					<input type="submit" class="btn btn-primary" name="at" id="rt" value="Actualizar Datos">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->


		

		
<?php require_once 'includes/lateral.php'; ?>		
<?php require_once 'includes/pie.php'; ?>
