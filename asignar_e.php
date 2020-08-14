<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
    require_once 'includes/conexion.php';
	$id = $_GET["id"];
		
    $sql="SELECT 
            id_especialidad, nombreEspecialidad 
        FROM 
            especialidades e 
        WHERE 
            id_especialidad NOT IN (SELECT 
                                            ti.cod_especialidad 
                                        FROM 
                                            tiene ti 
                                        WHERE 
                                            ti.cedula_profe= '$id');";
	$especialidad = pg_Exec($db,$sql);
    $filas = pg_NumRows($especialidad);


    if (isset($_POST["at"])){
        $especialidad = $_POST["especialidad"];
        $id = $_POST["id"];
       
		$sql="INSERT INTO 
                tiene(cedula_profe, cod_especialidad) 
        VALUES 
            ('$id','$especialidad')";
		$final=pg_Exec($db,$sql);
		
		if($final==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_e.php");
		}

	}

?>

<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>Asignar Especialidad a Prof. </h1>
        <?php
            if(pg_NumRows($especialidad) >= 1):
        ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" src="cedula">Seleccione su especialidad</label>
                                <select class="form-control" name="especialidad">
                                <?php 
                                
                                for ($j=0; $j < $filas; $j++):
                                    ?>
                                        <option value="<?=pg_result($especialidad, $j, 0)?>"><?=pg_result($especialidad, $j, 1)?></option>
                                <?php
                                    endfor;
                                ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                    <input type="hidden" name ="id" value="<?=$id?>" style="display:hidden;">
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
