<?php require_once 'includes/conexion.php'; 
if (isset($_POST["is"])){
	$login=$_POST["login"];
	$password=$_POST["password"];

	$sql = "SELECT * FROM Usuarios_Pass WHERE usuario='$login' and pass='$password'";
	$result = pg_Exec($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	$count = pg_NumRows($result);
  
		if($filas == 1) {
			session_start();
			$_SESSION["usuario"]=$_POST["login"];
		   header("location:Mostrar_t.php");
		}else {
			header("location:login.php");
		}

}?>


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
						<label for="" src="login">Usuario;</label>
						<input type="text" autofocus name="login" class="form-control" id="login" >
					</div>
					<div class="form-group">
						<label for="" src="password">Contrasena:</label>
						<input type="password" name="password" class="form-control" id="password">
					</div>
					<input type="submit" class="btn btn-primary" name="is" id="is" value="Login">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

	
<?php require_once 'includes/pie.php'; ?>