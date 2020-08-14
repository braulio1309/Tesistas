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
    $resultado = array();
    $resultado = $profe;

    require_once 'includes/cabecera.php';
?>

<div id="">
    
	<div class="container">
		<h1>Asignar Jurados </h1>
        <?php
            if(pg_NumRows($resultado) >= 1):
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
                                
                                    while($entrada = mysqli_fetch_assoc($resultado)):
                                ?>
                                        <option value="<?=$entrada['cedula_profe']?>"><?=$entrada['nombreProfe']?></option>
                                <?php
                                    endwhile;
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