<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>

		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Trabajos</h1>
		<form action="busqueda_tr.php" method="POST">
			<div class="row">
				<div class="col-sm-8">
					<input type="text" name="parametro" placeholder="Busque algun trabajo" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
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
                   
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['id_tg'] ?> </td>	
							<td> <?= $entrada['titulo']?> </td>
							<td> <?= $entrada['nroConsejo']?> </td>
							<td> <?= $entrada['Fecha_presentacion']?> </td>	
                            <td> <?= $entrada['horaPresentacion']?> </td>
                            <td> <?= $entrada['fechaAprobacion']?> </td>
							<td> <?= $entrada['tipo_formato']?> </td>

                            <td><a href="eliminar_tr.php?id=<?=$entrada['id_tg'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="detalles_tr.php?id=<?=$entrada['id_tg'] ?>"><input class="btn btn-success" type="button" value="Detalles"></a></td>					

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