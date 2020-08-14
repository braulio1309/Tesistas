<?php
require_once 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM formatos WHERE id_formato = '$id'";
    $criterios = pg_Exec($db, $sql);

    $resultado = array();
    $resultado = $criterios;
    $resultado = mysqli_fetch_assoc($resultado);
    if($resultado['tipo_formato'] == 'tutor_tig'){
        $sql="SELECT * FROM criterios_tutor_tig WHERE id_formato = '$id'";
        $formato = pg_Exec($db,$sql);
        
    }else
        if($resultado['tipo_formato'] == 'tutor_teg'){

            $sql="SELECT * FROM criterios_tutor_teg WHERE id_formato = '$id'";

            $formato = pg_Exec($db,$sql);

        }else
            if($resultado['tipo_formato'] == 'revisor_tig'){

                $sql="SELECT * FROM criterios_revisor_tig WHERE id_formato = '$id'";

                $formato = pg_Exec($db,$sql);

            }else
                if($resultado['tipo_formato'] == 'revisor_teg'){

                    $sql="SELECT * FROM criterios_revisor_teg WHERE id_formato = '$id'";

                    $formato = pg_Exec($db,$sql);

                }else
                    if($resultado['tipo_formato'] == 'jurado_tig'){

                        $sql="SELECT * FROM criterios_jurado_tig WHERE id_formato = '$id'";

                        $formato = pg_Exec($db,$sql);

                    }else
                        if($resultado['tipo_formato'] == 'jurado_teg'){

                            $sql="SELECT * FROM criterios_jurado_teg WHERE id_formato = '$id'";

                            $formato = pg_Exec($db,$sql);
                        }
            $entradas = array();
            $entradas = $formato;
?>

<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>


		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Criterios</h1>
		<form action="busqueda_f.php" class="" method="POST">
			<div class="row">
		
				
				<div class="col-sm-2">
					<a href="registro_c.php?id=<?=$id?>" class="btn btn-success">Nuevo</a>
				</div>
			</div>
		</form>
		<table class="table">
		   <thead>
				
				<th>Criterio</th>
				
                <th>&nbsp</th>
                <th>&nbsp</th>
		    </thead>		
			
			<tbody>
				<?php 
					if(!empty($entradas)):
						while($entrada = mysqli_fetch_assoc($entradas)):
						?>
							<tr>
								
							<td> <?= $entrada['criterio']?> </td>
                            <td><a href="eliminar_f.php?id=<?=$entrada['id_especialidad'] ?>"><input class="btn btn-danger"type="button" value="Borrar"></a></td>
                            <td><a href="Actualizar_f.php?id=<?=$entrada['id_formato'] ?>"><input class="btn btn-success" type="button" value="Actualizar"></a></td>					
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