<?php require_once 'includes/cabecera.php'; ?>
		
<?php require_once 'includes/lateral.php'; ?>
		
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>CLIENTES AFILIADOS EL AÑO PASADO Y ESTAN RETIRADOS</h1>

		<table class="table">
		   <thead>
				<th>NumCliente</th>
				<th>NombreC</th>
				<th>Direccion</th>
				<th>FechaAfiliacion</th>
		    </thead>		
			
			<tbody>
				<?php 
					$entradas = clientesRetirados($db);
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['num_cliente'] ?> </td>	
							<td> <?= $entrada['nombre']?> </td>
							<td> <?= $entrada['direccion']?> </td>
							<td> <?= $entrada['fecha_afiliacion']?> </td>						
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