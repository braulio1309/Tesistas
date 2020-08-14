<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
	require_once 'includes/conexion.php';
	$id = isset($_GET["id"])? $_GET["id"]: null;
		
    $sql="SELECT 
			pr.num_correlativo, pr.f_entrega_esc, pr.f_presentacion_comite, pr.aprobacionComite, pr.f_aprobacion_comite, pr.titulo, pr.tipo_propuesta, p.nombreProfe, pr.comentario
		FROM 
			propuestas pr, profesores p
		WHERE 
			num_correlativo = '$id' AND
	 		p.cedula_profe = pr.cedula_profe";
	$propuestas = pg_Exec($db,$sql);

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
	$tesista = pg_Exec($db,$sql);
	$tesistas = array();
	$tesistas = $tesista;

    if (isset($_POST["at"])){

		$id = isset($_POST["id"]) ? $_POST["id"]: null;
		$titulo = isset($_POST["titulo"]) ? $_POST["titulo"]: null;
		$nota = isset($_POST["nota"]) ? $_POST["nota"]: null;
		$titulo = isset($_POST["titulo"]) ? $_POST["titulo"]: null;
		$nombreTutor = isset($_POST["nombreTutor"]) ? $_POST["nombreTutor"]: null;
		$nombreEmpresa = isset($_POST["nombreEmpresa"]) ? $_POST["nombreEmpresa"]: null;
		$f_entrega_esc = isset($_POST["f_entrega_esc"]) ? $_POST["f_entrega_esc"]: null;
		$f_aprobacion_comite = isset($_POST["f_aprobacion_comite"]) ? $_POST["f_aprobacion_comite"]: null;
		$f_presentacion_comite = isset($_POST["f_presentacion_comite"]) ? $_POST["f_presentacion_comite"]: null;
		$profesorAvala = isset($_POST["profesorAvala"]) ? $_POST["profesorAvala"]: null;
		
		$sql = "UPDATE propuestas
				SET 
					f_entrega_esc = '$f_entrega_esc', f_presentacion_comite = '$f_presentacion_comite', aprobacionComite = '$nota', f_aprobacion_comite = '$f_aprobacion_comite', titulo = '$titulo'
				WHERE 
					num_correlativo = '$id'; ";
		$update = pg_Exec($db,$sql);
		

		if($resultado['tipo_propuesta'] == "Ins"){
			$sql = "UPDATE instrumentales
			SET 
				nombreEmpresa = '$nombreEmpresa', tutorEmpresarial = '$nombreTutor'
			WHERE 
				num_correlativo = '$id';  ";
			$instrumental = pg_Exec($db,$sql);
			
		}else{
			$sql = "UPDATE experimentales
			SET 
				profesorAvala = '$profesorAvala'
			WHERE 
				numr_correlativo = '$id';";
			$experimental = pg_Exec($db,$sql);
		}
		
		$sql = "SELECT * FROM propuestas WHERE num_correlativo = '$id' ORDER BY num_correlativo DESC";
		$propuesta = pg_Exec($db,$sql);
		$final = array();
		$final = $propuesta;

		$result = mysqli_fetch_assoc($final);
		
		//Cuando la propuesta esta aprobado se crea el trabajo
		
		if($result['aprobacionComite'] == 'APROBADO'){
			$sql = "INSERT 
						INTO 
							trabajos(nroCorrelativo) 
						VALUES 
							('$id')";
			$final = pg_Exec($db,$sql);
			
			$sql = "SELECT * FROM trabajos ORDER BY id_tg DESC";
			$trabajo = pg_Exec($db,$sql);
			$tra = array();
			$tra = $trabajo;
			$tra = mysqli_fetch_assoc($tra);

			$id_trabajo = $tra['id_tg'];
			if($result['tipo_propuesta'] == 'Ins'){
				$sql = "INSERT 
						INTO 
							instrumentales_tg(id_tg) 
						VALUES 
							('$id_tg')";
				$final = pg_Exec($db,$sql);

			}else{
				$sql = "INSERT 
						INTO 
							experimentales_tg(id_tg) 
						VALUES 
							('$id_tg')";
				$final = pg_Exec($db,$sql);
			}
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
						<input type="text"  class="form-control" value="<?=$tesi['nombre']?>" readonly>
						<input type="hidden" name="id" class="form-control" value="<?=$resultado['num_correlativo']?>" readonly>

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
							<div class="form-group">
								<label  src="cedula">Tutor</label>
								<input type="text" class="form-control" value="<?=$resultado['nombreProfe']?>" readonly>
							</div>
						</div>
                    </div>
					<?php
						if($resultado['aprobacionComite'] == 'APROBADO' ):
					?>
					<div class="row">
						<div class="col-sm-12">
							<label>Calificación de comité</label>
							<input type="text" name ="nota" class="form-control"  value="<?=$resultado['aprobacionComite']?>" readonly>
						</div>
					<?php
						else:
					?>
							<div class="row">
							<div class="col-sm-12">
								<label>Calificación de comité</label>
								<select name="nota" class="form-control">
									<option value="PENDIENTE">PENDIENTE</option>
									<option value="APROBADO">APROBADO</option>
									<option value="REPROBADO">REPROBADO</option>
								</select>
							</div>
					<?php
						endif;
					?>
					
                        
                    </div>

					<div class="row">
						<div class="col-sm-4">
							<label>Fecha entrega escuela</label>
							<input type="date" name="f_entrega_esc" class="form-control" value="<?=$resultado['f_entrega_esc']?>" >
						</div>
						<div class="col-sm-4">
							<label>fecha presentación comité</label>
							<input type="date" name="f_presentacion_comite" class="form-control" value="<?=$resultado['f_presentacion_comite']?>">
						</div>
						<div class="col-sm-4">
							<label>fecha aprobación comité</label>
							<input type="date" name="f_aprobacion_comite" class="form-control" value="<?=$resultado['f_aprobacion_comite']?>" >
						</div>
					</div>

					<div class="row">
						<?php
							if($resultado['tipo_propuesta'] == 'Ins'): 
						?>
							<div class="col-sm-6">
								<label>Nombre Empresa</label>
								<input type="text" name="nombreEmpresa" class="form-control" value="" >	
							</div>
							<div class="col-sm-6">
								<label>Tutor Empresa</label>
								<input type="text" name="nombreTutor" class="form-control" value="" >	
							</div>
						<?php
							else: 
						?>
							<div class="col-sm-6">
								<label>Profesor que avala</label>
								<input type="text" name="profesorAvala" class="form-control" value="" >	
							</div>
						<?php
							endif;
						?>
					</div>
                    
<br>
                    
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="at" id="rt" value="Registrar Propuesta">
					<a href="eliminar_pr.php?id=<?=$entrada['num_correlativo'] ?>"><input class="btn btn-danger"type="button" value="Borrar">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->