<?php require_once 'includes/cabecera.php'; ?>
<div class="row">
    <div class="col-sm-2">
		<a href="tutor_tig_f.php" class="btn btn-primary">Tutor tig</a>
	</div>
	<div class="col-sm-2">
		<a href="tutor_teg_f.php" class="btn btn-success">tutor teg</a>
	</div>
	<div class="col-sm-2">
		<a href="revisor_tig_f.php" class="btn btn-danger">Revisor tig</a>
	</div>
	<div class="col-sm-2">
		<a href="revisor_teg_f.php" class="btn btn-warning">Revisor teg</a>
	</div>
	
	<div class="col-sm-2">
		<a href="jurado_tig_f.php" class="btn btn-primary">Jurado tig</a>
	</div>

    <div class="col-sm-2">
		<a href="jurado_teg_f.php" class="btn btn-primary">Jurado teg</a>
	</div>
</div>
<?php require_once 'includes/braulio.php'; ?>


		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Formato</h1>
		<form action="busqueda_f.php" class="" method="POST">
			<div class="row">
		
				<div class="col-sm-8">
					<input type="text" name="parametro" placeholder="Busque algun formato" class="form-control">
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<div class="col-sm-2">
					<a href="registro_f.php" class="btn btn-success">Nuevo</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				<th>id</th>
				<th>Nombre Formato</th>
				
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					$entradas = formatos($db);
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
							<td> <?= $entrada['id_formato'] ?> </td>	
							<td> <?= $entrada['nombre']?> </td>
                            <td><a href="eliminar_f.php?id=<?=$entrada['id_especialidad'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="mostrar_c-f.php?id=<?=$entrada['id_formato'] ?>"><input class="btn btn-success" type="button" value="Criterios"></a></td>					
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