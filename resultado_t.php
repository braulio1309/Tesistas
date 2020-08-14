<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
    <h1>TESISTAS</h1>
		<form action="busqueda_t.php" class="" method="POST">
			<div class="row">
		
			<div class="col-sm-8">
				<input type="text" name="parametro" placeholder="Busque algún tesista" class="form-control">
			</div>
			<div class="col-sm-4">
				<input type="submit" class="btn btn-primary" value="Buscar">
			</div>
		
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>Cedula</th>
				<th>Nombre</th>
				<th>Correo UCAB</th>
				<th>Correo Particular</th>
                <th>Telefono</th>
                <th>Sexo</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					$filas = pg_numRows($entradas);
					if(!empty($entradas)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
							<td> <?= pg_result($entradas, $j, 0) ?> </td>	
							<td> <?= pg_result($entradas, $j, 1) ?> </td>
							<td> <?= pg_result($entradas, $j, 2)?> </td>
							<td> <?= pg_result($entradas, $j, 3)?> </td>	
                            <td> <?= pg_result($entradas, $j, 4)?> </td>
							<td> <?= pg_result($entradas, $j, 5)?> </td>
                            <td><a href="eliminar_t.php?cedula=<?=pg_result($entradas, $j, 0) ?>"  ><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_T.php?cedula=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
							</tr>
				<?php
						endfor;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
</div> <!--fin principal-->
<?php require_once 'includes/pie.php'; ?>