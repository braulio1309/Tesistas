<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>


		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>TESISTAS</h1>

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
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['id_especialidad'] ?> </td>	
							<td> <?= $entrada['nombreEspecialidad']?> </td>
                            <td><a href="eliminar_e.php?id=<?=$entrada['id_especialidad'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_e.php?id=<?=$entrada['id_especialidad'] ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
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