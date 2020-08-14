<?php require_once 'includes/cabecera.php'; ?>
<div class="row">
    <div class="col-sm-2">
		<a href="instrumentales_tr.php" class="btn btn-primary">Instrumental</a>
	</div>
	
	<div class="col-sm-2">
		<a href="experimentales_tr.php" class="btn btn-primary">Experimental</a>
	</div>
</div>
<?php require_once 'includes/braulio.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Trabajos</h1>
		<form action="busqueda_tr.php" method="POST">
			<div class="row">
				<div class="col-sm-6">
					<input type="text" name="parametro" placeholder="Busque algun trabajo" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="excel_tr.php" class="btn btn-success">Descargar</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>ID</th>
				<th>Título</th>
				<th>Nro Consejo</th>
				<th>Fecha presentación</th>
                <th>Hora presentación</th>
                <th>Fecha aprobación</th>
                <th>Tipo</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
                    $entradas = mostrartrabajos($db);
					$filas = pg_NumRows($entradas);

					if(!empty($entradas)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
							<td> <?= pg_result($entradas, $j, 0)				?> </td>	
							<td> <?= pg_result($entradas, $j, 1)		?> </td>
							<td> <?= pg_result($entradas, $j, 2)		?> </td>
							<td> <?= pg_result($entradas, $j, 3)	?> </td>	
                            <td> <?= pg_result($entradas, $j, 4)	?> </td>
                            <td> <?= pg_result($entradas, $j, 5)?> </td>
							<td> <?= pg_result($entradas, $j, 6)		?> </td>

                            <td><a href="eliminar_tr.php?id=<?=pg_result($entradas, $j, 0) ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="detalles_tr.php?id=<?=pg_result($entradas, $j, 0) ?>&num_correlativo=<?=pg_result($entradas, $j, 7)?>"><input class="btn btn-success" type="button" value="Detalles"></a></td>					

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