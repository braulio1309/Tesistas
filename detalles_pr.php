<?php require_once 'includes/cabecera.php'; ?>
<?php
    require_once 'includes/conexion.php';
	$id = $_GET["id"];
		
    $sql="SELECT 
			pr.num_correlativo, pr.f_entrega_esc, pr.f_presentacion_comite, pr.aprobacionComite, pr.f_aprobacion_comite, pr.titulo, pr.tipo_propuesta, p.nombreProfe, pr.comentario
		FROM 
			propuestas pr, profesores p
		WHERE 
			num_correlativo = '$id' AND
	 		p.cedula_profe = pr.cedula_profe";
	$propuestas = mysqli_query($db,$sql);

    $resultado = array();
	$resultado = $propuestas;
	$resultado = mysqli_fetch_assoc($resultado);

	$sql = "SELECT 
				t.nombre 
			FROM 
				presentan p, tesistas t 
			WHERE 
				p.nroCorrelativo = '$id' AND
				p.cedulaTesista = t.cedula";
	$tesista = mysqli_query($db,$sql);
	$tesistas = array();
	$tesistas = $tesista;

    if (isset($_POST["at"])){
		$nombre = $_POST["nombre"];
		$sql="UPDATE especialidades SET (nombreEspecialidad ='$nombre' WHERE id_especialidad='$id')";
		$final=mysqli_query($db,$sql);

		if($final==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}

	}

?>

<div class="container">
		<h1>Actualización de propuesta</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
				<?php 
                                
					while($tesi = mysqli_fetch_assoc($tesista)):
                ?>
					<div class="form-group">
						<label  src="cedula">Autor</label>
						<input type="text"  autofocus name="cedula1" class="form-control" value="<?=$tesi['nombre']?>" readonly>
					</div>
				<?php
					endwhile;
				?>
                   

					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" value="<?= $resultado['titulo']?>">
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label>Tipo de tesis</label>
							<input type="text" class="form-control"  value="<?=$resultado['tipo_propuesta']?>" readonly>
						</div>
                    </div>

					<div class="row">
						<div class="col-sm-12">
							<label>Tutor </label>
							<div class="form-group">
								<label  src="cedula">Tutor</label>
								<input type="text"  autofocus name="cedula1" class="form-control" value="<?=$resultado['nombreProfe']?>" readonly>
							</div>
						</div>
                    </div>

					<div class="row">
						<div class="col-sm-12">
							<label>Calificación de comité</label>
							<input type="text" class="form-control"  value="<?=$resultado['aprobacionComite']?>" readonly>
						</div>
                        
                    </div>

					<div class="row">
						<div class="col-sm-4">
							<label>Fecha entrega escuela</label>
							<input type="text" class="form-control" value="<?=$resultado['f_entrega_esc']?>" >
						</div>
						<div class="col-sm-4">
							<label>fecha presentación comité</label>
							<input type="text" class="form-control" value="<?=$resultado['f_presentacion_comite']?>">
						</div>
						<div class="col-sm-4">
							<label>fecha aprobación comité</label>
							<input type="text" class="form-control" value="<?=$resultado['f_aprobacion_comite']?>" >
						</div>
					</div>

					<div class="row">
						<?php
							if($resultado['tipo_propuesta'] == 'Ins'): 
						?>
							<div class="col-sm-6">
								<label>Nombre Empresa</label>
								<input type="text" class="form-control" value="#" >	
							</div>
							<div class="col-sm-6">
								<label>Tutor Empresa</label>
								<input type="text" class="form-control" value="#" >	
							</div>
						<?php
							else: 
						?>
							<div class="col-sm-6">
								<label>Profesor que avala</label>
								<input type="text" class="form-control" value="#" >	
							</div>
						<?php
							endif;
						?>
					</div>
                    
<br>
                    
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar Propuesta">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->