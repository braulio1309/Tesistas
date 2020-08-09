<?php require_once 'includes/conexion.php'; ?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>LOGIN</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="usuario">Usuario;</label>
						<input type="text" autofocus name="cedula" class="form-control" id="cedula" >
					</div>
					<div class="form-group">
						<label for="" src="password">Contrasena:</label>
						<input type="password" name="password" class="form-control" id="password">
					</div>
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Login">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

	
<?php require_once 'includes/pie.php'; ?>