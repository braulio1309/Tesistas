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
    $profe = pg_Exec($db, $sql);
	$filas = pg_NumRows($profe);
    

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
					if(!empty($profe)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
                                <td> <?= pg_result($profe, $j, 0) ?> </td>	
                                <td> <?= pg_result($profe, $j, 1)?> </td>
                            
							</tr>
				<?php
						endfor;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
<?php require_once 'includes/pie.php'; ?>