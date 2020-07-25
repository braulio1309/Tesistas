<?php require_once 'includes/cabecera.php'; ?>
		

		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>TESISTAS</h1>

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
					$entradas = mostrarTesistas($db);
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['cedula'] ?> </td>	
							<td> <?= $entrada['nombre']?> </td>
							<td> <?= $entrada['correo_ucab']?> </td>
							<td> <?= $entrada['correo_part']?> </td>	
                            <td> <?= $entrada['telefono']?> </td>
							<td> <?= $entrada['sexo']?> </td>
                            <td><a href="eliminar_t.php?cedula=<?=$entrada['cedula'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_T.php?cedula=<?=$entrada['cedula'] ?> & nombre=<?=$entrada['nombre'] ?> & correo_ucab=<?=$entrada['correo_ucab'] ?> & correo_part=<?=$entrada['correo_part'] ?> & telefono=<?=$entrada['telefono'] ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
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