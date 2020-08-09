<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>


		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Profesores</h1>
		<form action="busqueda_e.php" class="" method="POST">
			<div class="row">
		
				<div class="col-sm-8">
					<input type="text" name="parametro" placeholder="Busque alguna especialidad" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="registro_p.php" class="btn btn-success">Nuevo</a>
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
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['cedula_profe'] ?> </td>	
							<td> <?= $entrada['nombreProfe']?> </td>
                            <td> <?= $entrada['direccionProfe']?> </td>
                            <td> <?= $entrada['telefonoProfe']?> </td>
                            <td> <?= $entrada['correoProfe']?> </td>

                            <td><a href="eliminar_p.php?id=<?=$entrada['cedula_profe'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_p.php?id=<?=$entrada['cedula_profe'] ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
                            <td><a href="mostrar_p-e.php?id=<?=$entrada['cedula_profe'] ?>"><input class="btn btn-primary" type="button" value="Especialidades"></a></td>					

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