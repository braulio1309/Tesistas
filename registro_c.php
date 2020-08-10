<?php require_once 'includes/conexion.php';
    $id = $_GET['id'];

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>Registro de criterio a evaluar en el formato</h1>
		<form action="registro_c-back.php?id=<?=$id?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Describa el criterio</label>
                        <textarea name="criterio" rows="10" cols="50"></textarea>
					</div>
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar criterio">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

	
<?php require_once 'includes/pie.php'; ?>