<?php
require_once 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT 
                f.nombre 
            FROM 
                formatos f, criterios_tutor_tig ct, criterios_tutor_teg ctt, criterios_revisor_tig crti, criterios_revisor_teg crte, criterios_jurado_tig cjti, criterios_jurado_teg cjte
            WHERE
                (f.id_formato = ct.id_formato OR 
                f.id_formato = ct.id_formato OR 
                f.id_formato = ctt.id_formato OR 
                f.id_formato = crti.id_formato OR 
                f.id_formato = crte.id_formato OR 
                f.id_formato = cjti.id_formato OR 
                f.id_formato= cjte.id_formato)";
                                               
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