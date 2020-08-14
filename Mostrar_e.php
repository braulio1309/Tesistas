<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>
		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Especialidades</h1>
		<form action="busqueda_e.php" class="" method="POST">
			<div class="row">
		
				<div class="col-sm-6">
					<input type="text" name="parametro" placeholder="Busque alguna especialidad" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="registro_e.php" class="btn btn-success">Nuevo</a>
				</div>
				<div class="col-sm-2">
					<a href="excel_e.php" class="btn btn-success">Descargar</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>id</th>
				<th>Nombre especialidad</th>
				
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					$entradas = mostrarEspecialidad($db);
					$filas = pg_NumRows($entradas);

					if(!empty($entradas)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
							<td> <?= pg_result($entradas, $j, 0) ?> </td>	
							<td> <?= pg_result($entradas, $j, 1)?> </td>
                            <td><a href="eliminar_e.php?id=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_e.php?id=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
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