<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>

		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Propuestas</h1>
		<form action="busqueda_pr.php" method="POST">
			<div class="row">
				<div class="col-sm-8">
					<input type="text" name="parametro" placeholder="Busque alguna propuesta" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="registro_pr.php" class="btn btn-success">Nuevo</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>ID</th>
				<th>Título</th>
				<th>Fecha entrega escuela</th>
				<th>Fecha Comité</th>
                <th>Nota Comité</th>
                <th>Fecha Comité</th>
                <th>Tipo</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					$entradas = mostrarPropuestas($db);
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['num_correlativo'] ?> </td>	
							<td> <?= $entrada['titulo']?> </td>
							<td> <?= $entrada['f_entrega_esc']?> </td>
							<td> <?= $entrada['f_presentacion_comite']?> </td>	
                            <td> <?= $entrada['aprobacionComite']?> </td>
                            <td> <?= $entrada['f_aprobacion_comite']?> </td>
							<td> <?= $entrada['tipo_propuesta']?> </td>

                            <td><a href="eliminar_pr.php?id=<?=$entrada['id'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_pr.php?id=<?=$entrada['id'] ?>"><input class="btn btn-success" type="button" value="Detalles"></a></td>					
							</tr>
				<?php
						endwhile;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
</div> <!--fin principal-->
<?php require_once 'includes/pie.php'; ?>