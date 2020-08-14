<?php
require_once 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM formatos WHERE id_formato = '$id'";
    $criterios = pg_Exec($db, $sql);

   
    if(pg_result($criterios,0,2) == 'tutor_tig'){
        $sql="SELECT * FROM criterios_tutor_tig WHERE id_formato = '$id'";
        $formato = pg_Exec($db,$sql);
        
    }else
        if(pg_result($criterios,0,2) == 'tutor_teg'){

            $sql="SELECT * FROM criterios_tutor_teg WHERE id_formato = '$id'";

            $formato = pg_Exec($db,$sql);

        }else
            if(pg_result($criterios,0,2) == 'revisor_tig'){

                $sql="SELECT * FROM criterios_revisor_tig WHERE id_formato = '$id'";

                $formato = pg_Exec($db,$sql);

            }else
                if(pg_result($criterios,0,2) == 'revisor_teg'){

                    $sql="SELECT * FROM criterios_revisor_teg WHERE id_formato = '$id'";

                    $formato = pg_Exec($db,$sql);

                }else
                    if(pg_result($criterios,0,2) == 'jurado_tig'){

                        $sql="SELECT * FROM criterios_jurado_tig WHERE id_formato = '$id'";

                        $formato = pg_Exec($db,$sql);

                    }else
                        if(pg_result($criterios,0,2) == 'jurado_teg'){

                            $sql="SELECT * FROM criterios_jurado_teg WHERE id_formato = '$id'";

                            $formato = pg_Exec($db,$sql);
                        }
           
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
                        for ($j=0; $j < $filas; $j++):
                            ?>
							<tr>
								
							<td> <?= pg_result($formato,$j, 1)?> </td>
                            
							</tr>
				<?php
						endfor;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
</div> <!--fin principal-->
<?php require_once 'includes/pie.php'; ?>