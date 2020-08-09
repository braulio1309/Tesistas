<?php
    require_once 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT 
	            p.cedula_profe, p.nombreProfe
            FROM 
	            es_jurado , profesores p
            WHERE 
                (jurado_profe1 =p.cedula_profe OR 
                jurado_profe2 = p.cedula_profe OR 
                jurado_profe3 = p.cedula_profe OR 
                jurado_profe4 = p.cedula_profe) AND
                id_tg = $id";
    $profe = mysqli_query($db, $sql);
    $resultado = array();
    $resultado = $profe;
    

?>

<?php require_once 'includes/cabecera.php'; ?>


		
<!-- CAJA PRINCIPAL -->
    
	<div class="container">
		<h1>Jurados</h1>
        <div class="col-sm-2">
            <a href="asignar_j?id=<?=$id?>" class="btn btn-success">Añadir</a>

        </div>
        <br/>

		<table class="table">
		   <thead>
				<th>id</th>
				<th>Jurado</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					if(!empty($resultado)):
						while($entrada = mysqli_fetch_assoc($resultado)):
						?>
							<tr>
                                <td> <?= $entrada['cedula_profe'] ?> </td>	
                                <td> <?= $entrada['nombreProfe']?> </td>
                            
							</tr>
				<?php
						endwhile;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
<?php require_once 'includes/pie.php'; ?>