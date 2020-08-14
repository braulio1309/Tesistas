<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Propuestas</h1>
		<form action="busqueda_pr.php" class="" method="POST">
			<div class="row">
		
			<div class="col-sm-8">
				<input type="text" name="parametro" placeholder="Busque alguna propuesta" class="form-control">
			</div>
			<div class="col-sm-4">
				<input type="submit" class="btn btn-primary" value="Buscar">
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
                <th>Fecha CE</th>
                <th>Tipo</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					if(!empty($entradas)):
						for ($j=0; $j < $filas; $j++):
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
                            <td><a href="Actualizar_pr.php?id=<?=$entrada['id'] ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
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