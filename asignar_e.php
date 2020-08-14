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
	$especidalidad = pg_Exec($db,$sql);

    $entradas = array();
	$entradas = $especidalidad;

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
            if(pg_NumRows($entradas) >= 1):
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
                                
                                    while($entrada = mysqli_fetch_assoc($entradas)):
                                ?>
                                        <option value="<?=$entrada['id_especialidad']?>"><?=$entrada['nombreEspecialidad']?></option>
                                <?php
                                    endwhile;
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
