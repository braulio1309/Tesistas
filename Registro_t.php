<?php require_once 'includes/conexion.php';

	if (isset($_POST["rt"])){
		$cedula=$_POST["cedula"];
		$nombre=$_POST["nombre"];
		$correo_ucab=$_POST["correo_ucab"];
		$correo_part=$_POST["correo_part"];
		$telefono=$_POST["telefono"];
		$sexo=$_POST["sexo"];
		$sql="INSERT INTO tesistas(cedula, nombre, correo_ucab, correo_part, telefono, sexo) VALUES ('$cedula','$nombre','$correo_ucab','$correo_part','$telefono','$sexo')";
		$tesista=mysqli_query($db,$sql);

		if($tesista==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}

	}

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>REGISTRO DE TESISTA</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Cedula</label>
						<input type="text" autofocus name="cedula" class="form-control" id="cedula" >
					</div>
					<div class="form-group">
						<label for="" src="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control" id="nombre">
					</div>
					<div class="form-group">
						<label for="" src="correo_u">Correo UCAB</label>
						<input type="email"  name="correo_ucab" class="form-control" id="correo_ucab" >
					</div>
					<div class="form-group">
						<label for="" src="correo_p">Correo Particular</label>
						<input type="email"  name="correo_part" class="form-control" id="correo_part" >
					</div>
					<div class="form-group">
						<label for="" src="telefono">Telefono</label>
						<input type="number" name="telefono" class="form-control" id="telefono" >
					</div>
					<div class="form-group">
					<label for=""> GENERO: </label>
						<br>
						<input class="radio-inline" type="radio" name="sexo" id="" value="M" >M
						<input class="radio-inline" type="radio" name="sexo" id="" value="F">F 
					</div>
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar Tesista">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

<?php require_once 'includes/lateral.php'; ?>
	
<?php require_once 'includes/pie.php'; ?>