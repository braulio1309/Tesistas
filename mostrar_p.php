<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>


		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Profesores</h1>
		<form action="busqueda_e.php" class="" method="POST">
			<div class="row">
		
				<div class="col-sm-6">
					<input type="text" name="parametro" placeholder="Busque alguna especialidad" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="registro_p.php" class="btn btn-success">Nuevo</a>
				</div>

				<div class="col-sm-2">
					<a href="excel_p.php" class="btn btn-success">Descargar</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>Cédula</th>
				<th>Nombre</th>
                <th>Dirección</th>
				<th>Telefono</th>
				<th>Correo</th>

                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					$entradas = mostrarProfesores($db);
					$filas = pg_NumRows($entradas);

					if(!empty($entradas)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
								<td> <?= pg_result($entradas, $j, 0) ?> </td>	
								<td> <?= pg_result($entradas, $j, 1)	?> </td>
								<td> <?= pg_result($entradas, $j, 2)	?> </td>
								<td> <?= pg_result($entradas, $j, 3)	?> </td>
								<td> <?= pg_result($entradas, $j, 4)	?> </td>

								<td><a href="eliminar_p.php?id=<?=pg_result($entradas, $j, 0)?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
								<td><a href="Actualizar_p.php?id=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
								<td><a href="mostrar_p-e.php?id=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-primary" type="button" value="Especialidades"></a></td>					

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