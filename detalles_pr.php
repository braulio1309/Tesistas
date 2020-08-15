<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
	require_once 'includes/conexion.php';
	$id = isset($_GET["id"])? $_GET["id"]: $_POST["id"];
		
    $sql="SELECT 
			pr.num_correlativo, pr.f_entrega_esc, pr.f_presentacion_comite, pr.aprobacionComite, pr.f_aprobacion_comite, pr.titulo, pr.tipo_propuesta, p.nombreProfe, pr.comentario
		FROM 
			propuestas pr, profesores p
		WHERE 
			num_correlativo = '$id' AND
	 		p.cedula_profe = pr.cedula_profe";
	$entradas = pg_Exec($db,$sql);
	if(pg_result($entradas,0,6)=='Instrumental'){
		$sql="SELECT 
		*
		FROM 
			instrumentales
		WHERE 
			nro_correlativo = '$id'";
		$aparte = pg_exec($db,$sql);
	}else{
		$sql="SELECT 
				*
			FROM 
				experimentales
			WHERE 
				numr_correlativo = '$id'";
		$aparte = pg_exec($db,$sql);
	}

    
	$sql = "SELECT 
				t.nombre 
			FROM 
				presentan p, tesistas t 
			WHERE 
				p.nroCorrelativo = '$id' AND
				p.cedulaTesista = t.cedula";
	$tesista = pg_Exec($db,$sql);
	$filas = pg_NumRows($tesista);
	

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
		

		if(pg_result($entradas,0,6) == "Instrumental"){
			$sql = "UPDATE instrumentales
			SET 
				nombreEmpresa = '$nombreEmpresa', tutorEmpresarial = '$nombreTutor'
			WHERE 
				nro_correlativo = '$id';  ";
			$instrumental = pg_Exec($db,$sql);
			
		}else{
			$sql = "UPDATE experimentales
			SET 
				profesorAvala = '$profesorAvala'
			WHERE 
				numr_correlativo = '$id';";
			$experimental = pg_Exec($db,$sql);
		}
		
		$sql = "SELECT num_correlativo, aprobacionComite FROM propuestas WHERE num_correlativo = '$id'";
		$propuesta = pg_Exec($db,$sql);
		
		//Cuando la propuesta esta aprobado se crea el trabajo
		$id =pg_result($propuesta,0,0);
		if(pg_result($propuesta,0,1) == 'APROBADO'){
			$sql = "INSERT 
						INTO 
							trabajos(nroCorrelativo) 
						VALUES 
							('$id')";
			//var_dump($sql);die();
			$final = pg_Exec($db,$sql);
			
			$sql = "SELECT * FROM trabajos ORDER BY id_tg DESC";
			$trabajo = pg_Exec($db,$sql);
			

			$id_tg = pg_result($trabajo, 0,0);
			if(pg_result($entradas,0,8) == 'Instrumental'){
				$sql = "INSERT 
						INTO 
							tig(id_tg) 
						VALUES 
							('$id_tg')";
				$final = pg_Exec($db,$sql);

			}else{
				$sql = "INSERT 
						INTO 
							teg(id_tg) 
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
                                
					for ($j=0; $j < $filas; $j++):
									?>
						<div class="form-group">
							<label  src="cedula">Autor</label>
							<input type="text"  class="form-control" value="<?=pg_result($tesista, $j, 0)?>" readonly>
							<input type="hidden" name="id" class="form-control" value="<?=pg_result($entradas, 0, 0)?>" readonly>

						</div>
				<?php
					endfor;
				?>
                   

					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" value="<?= pg_result($entradas, 0, 5)?>">
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label>Tipo de tesis</label>
							<input type="text" class="form-control"  value="<?=pg_result($entradas, 0, 6)?>" readonly>
						</div>
                    </div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label  src="cedula">Tutor</label>
								<input type="text" class="form-control" value="<?=pg_result($entradas, 0, 7)?>" readonly>
							</div>
						</div>
                    </div>
					<?php
						if(pg_result($entradas, 0, 3) == 'APROBADO' ):
					?>
					<div class="row">
						<div class="col-sm-12">
							<label>Calificación de comité</label>
							<input type="text" name ="nota" class="form-control"  value="<?=pg_result($entradas, 0, 3)?>" readonly>
						</div>
					<?php
						else:
					?>
							<div class="row">
							<div class="col-sm-12">
								<label>Calificación de comité</label>
								<select name="nota" class="form-control">
									<option value="">PENDIENTE</option>
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
							<input type="date" name="f_entrega_esc" class="form-control" value="<?=pg_result($entradas, 0, 0)?>" >
						</div>
						<div class="col-sm-4">
							<label>fecha presentación comité</label>
							<input type="date" name="f_presentacion_comite" class="form-control" value="<?=pg_result($entradas, 0, 2)?>">
						</div>
						<div class="col-sm-4">
							<label>fecha aprobación comité</label>
							<input type="date" name="f_aprobacion_comite" class="form-control" value="<?=pg_result($entradas, 0, 5)?>" >
						</div>
					</div>

					<div class="row">
						<?php
						
							if(pg_result($entradas, 0, 6) == 'Instrumental'): 
						?>
							<div class="col-sm-6">
								<label>Nombre Empresa</label>
								<input type="text" name="nombreEmpresa" class="form-control" value="<?=pg_result($aparte,0,1)?>" >	
							</div>
							<div class="col-sm-6">
								<label>Tutor Empresa</label>
								<input type="text" name="nombreTutor" class="form-control" value="<?=pg_result($aparte,0,2)?>" >	
							</div>
						<?php
							else: 
						?>
							<div class="col-sm-6">
								<label>Profesor que avala</label>
								<input type="text" name="profesorAvala" class="form-control" value="<?=pg_result($aparte,0,1)?>" >	
							</div>
						<?php
							endif;
						?>
					</div>
                    
<br>
                    
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="at" id="rt" value="Registrar Propuesta">
					<a href="eliminar_pr.php?id=<?=pg_result($entradas, 0, 0) ?>"><input class="btn btn-danger"type="button" value="Borrar">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->