<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
    require_once 'includes/conexion.php';
	$id = isset($_GET["id"]) ? $_GET["id"]: null;
	$num_correlativo = isset($_GET["num_correlativo"]) ? $_GET["num_correlativo"]: null;
	if($id){
		$sql = "SELECT 
					t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato, p.tipo_propuesta
				FROM 
					trabajos t, propuestas p 
				WHERE 
					t.nroCorrelativo = p.num_correlativo AND
					t.id_tg = '$id'";
		$propuesta = pg_Exec($db, $sql);
		if(pg_result($propuesta, 0, 7) == 'Instrumental'){
		$sql = "SELECT  
					* 
				FROM 
					formatos f,  formato_jurado_tig ft
				WHERE
					f.id_formato = ft.id_formato";
		$formato = pg_Exec($db, $sql);
		$filas = pg_numRows($formato);
	}else{
		$sql = "SELECT  
					* 
				FROM 
					formatos f,  formato_jurado_teg ft
				WHERE
					f.id_formato = ft.id_formato";
		$formato = pg_Exec($db, $sql);
		$filas = pg_numRows($formato);
	}

$sql = "SELECT 
			t.nombre 
		FROM 
			presentan p, tesistas t 
		WHERE 
			p.nroCorrelativo = '$num_correlativo' AND
			p.cedulaTesista = t.cedula";

	$tesista = pg_Exec($db,$sql);
	$filasT = pg_numRows($tesista);

	
}		
	
    if (isset($_POST["at"])){
		$id = $_POST['id'];
		$consejo = isset($_POST["consejo"])?$_POST['consejo']:null;
		$fecha   = !empty($_POST['fecha'])?$_POST['fecha']:null;
		$hora 	 = !empty($_POST['hora'])?$_POST['hora']:null;
		$fechaApro 	 = !empty($_POST['fechaApro'])?$_POST['fechaApro']:null;
		$formato 	 = !empty($_POST['formato'])?$_POST['formato']:null;

//var_dump($formato);die();
		$sql="UPDATE 
				trabajos 
			 SET 
			 	nroConsejo = $consejo, Fecha_presentacion ='$fecha', horaPresentacion = '$hora', fechaAprobacion = '$fechaApro', tipo_formato='$formato'
			WHERE 
				id_tg='$id'";
		//var_dump($id);die();// Error no lo hace
		$final=pg_Exec($db,$sql);
		
		if($final==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_tr.php");
			exit;
		}

	}


?>

<div class="container">
		<h1>Actualización de trabajo</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				
				<?php 
                                
					for ($j=0; $j < $filasT; $j++):
				?>
					<div class="form-group">
						<label  src="cedula">Autor</label>
						<input type="text"  class="form-control" value="<?=pg_result($tesista,$j, 0)?>" readonly>
						<input type="hidden" name="id" class="form-control" value="<?=$num_correlativo?>" readonly>

					</div>
				<?php
					endfor;
				?>
<input type="hidden" name="id" class="form-control" value="<?=$id?>" readonly>

					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" value="<?=pg_result($propuesta,0, 1)?>" readonly>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label>Número de consejo</label>
							<input type="number" name="consejo" class="form-control"  value="<?=pg_result($propuesta,0, 2)?>" >
						</div>
                    </div>

					<div class="row">
						<div class="col-sm-4">
							<label>Fecha de presentación</label>
							<input type="date" name="fecha" class="form-control" value="<?=pg_result($propuesta,0, 3)?>" >
						</div>
						<div class="col-sm-4">
							<label>Hora presentación</label>
							<input type="time" name="hora" class="form-control" value="<?=pg_result($propuesta,0, 4)?>">
						</div>

						<div class="col-sm-4">
							<label>Fecha aprobación</label>
							<input type="date" name="fechaApro" class="form-control" value="<?=pg_result($propuesta,0, 5)?>">
						</div>

					</div>
<br>
					<div class="row">
						<select name="formato" class="form-control">
							<?php
								for($j=0; $j < $filas; $j++):
							?>
								<option value="<?=pg_result($formato,$j, 0)?>"><?=pg_result($formato,$j, 1)?></option>
							<?php
								endfor;
							?>
						</select>
					</div>
                
<br>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">					
								<input type="submit" class="btn btn-primary" name="at" id="at" value="Actualizar trabajo">
							</div>
						</div>
						
						<div class="col-sm-4">
							<a class="btn btn-success" href="mostrar_j?id=<?=pg_result($propuesta,0, 0)?>" >Ver Jurados</a>
						</div>

						<div class="col-sm-4">
							<a class="btn btn-success" href="juradoTEG_pdf?id=<?=pg_result($propuesta,0, 0)?>" >Anexos</a>
						</div>
					</div>
				</div>	
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->