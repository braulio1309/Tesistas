<?php
require_once 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT 
                cedula_profe, nombreProfe 
            FROM 
                profesores p
            WHERE
                p.cedula_profe NOT IN (SELECT 
                                            pr.cedula_profe 
                                        FROM 
                                            profesores pr, es_jurado j
                                        WHERE 
                                            (pr.cedula_profe = j.jurado_profe1 OR pr.cedula_profe = 		j.jurado_profe2 OR pr.cedula_profe = j.jurado_profe3 OR pr.cedula_profe = j.jurado_profe4) AND
                                            j.id_tg = '$id'
                                        GROUP BY 
                                            pr.cedula_profe
                                        HAVING 
                                            COUNT(pr.cedula_profe) < 5)";
                                               
    $profe = pg_Exec($db, $sql);
    $filas = pg_NumRows($profe);
    
    require_once 'includes/cabecera.php';
?>

<div id="">
    
	<div class="container">
		<h1>Asignar Jurados </h1>
        <?php
            if(pg_NumRows($profe) >= 1):
        ?>
		<form action="asignar_j_back.php" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" src="cedula">El jurado de la tesis</label>
                                
                                <select class="form-control" name="cedula">
                                <?php 
                                
                                for ($j=0; $j < $filas; $j++):
                                    ?>
                                        <option value="<?=pg_result($profe, $j, 0)?>"><?=pg_result($profe, $j, 1)?></option>
                                <?php
                                    endfor;
                                ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                    <input type="hidden" name ="id" value="<?=$id?>">
                                <input type="submit" class="btn btn-primary" name="at" id="rt" value="Asignar">

                            </div>
                        </div>
					</div>
					
				</div>
			</div>
		</form>
        <?php
        else:
        ?>
            <h3 class="text-center">No puede asignar más especialidades</h3>
        <?php
        endif;
        ?>
	</div>
</div> <!--fin principal-->


		

		
<?php require_once 'includes/lateral.php'; ?>		
<?php require_once 'includes/pie.php'; ?>