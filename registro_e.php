<?php require_once 'includes/conexion.php';

	if (isset($_POST["rt"])){
		
		$nombre=$_POST["especialidad"];
		
		$sql="INSERT INTO especialidades(nombreEspecialidad) VALUES ('$nombre')";
		$especialidad=pg_Exec($db,$sql);

		if($especialidad==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_e.php");
		}

	}

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
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
						<input type="text" autofocus name="especialidad" class="form-control" id="cedula" >
					</div>
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar especialidad">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

	
<?php require_once 'includes/pie.php'; ?>