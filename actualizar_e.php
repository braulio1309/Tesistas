<?php require_once 'includes/cabecera.php'; ?>
<?php
    require_once 'includes/conexion.php';
	$id = $_GET["id"];
		
    $sql="SELECT * FROM especialidades WHERE id_especialidad = '$id' ";
	$especidalidad = mysqli_query($db,$sql);

    $resultado = array();
	$resultado = $especidalidad;
	$resultado = mysqli_fetch_assoc($resultado);

    if (isset($_POST["at"])){
		$nombre = $_POST["nombre"];
		$sql="UPDATE 
				especialidades 
			SET 
				nombreEspecialidad ='$nombre' 
			WHERE 
				id_especialidad='$id'";
		$final=mysqli_query($db,$sql);
		
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
		<h1>REGISTRO DE TESISTA</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Nombre de la especialidad</label>
						<input type="text" autofocus name="nombre" class="form-control" id="cedula" value="<?=$resultado['nombreEspecialidad'] ?>">
					</div>
					
					<input type="submit" class="btn btn-primary" name="at" id="rt" value="Actualizar Datos">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->


		

		
<?php require_once 'includes/lateral.php'; ?>		
<?php require_once 'includes/pie.php'; ?>
