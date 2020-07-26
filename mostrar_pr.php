<?php require_once 'includes/cabecera.php'; ?>
		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>TESISTAS</h1>

		<table class="table">
		   <thead>
				<th>ID</th>
				<th>Título</th>
				<th>Fecha entrega escuela</th>
				<th>Fecha Comité</th>
                <th>Nota Comité</th>
                <th>Fecha Comité</th>
                <th>Fecha CE</th>
                <th>Comentarios</th>
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
							<td> <?= $entrada['id'] ?> </td>	
							<td> <?= $entrada['titulo']?> </td>
							<td> <?= $entrada['fecha_entrega']?> </td>
							<td> <?= $entrada['nota_comité']?> </td>	
                            <td> <?= $entrada['fecha_comité']?> </td>
							<td> <?= $entrada['fecha_ce']?> </td>
                            <td> <?= $entrada['Comentarios']?> </td>
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
<?php require_once 'includes/lateral.php'; ?>		
<?php require_once 'includes/pie.php'; ?>