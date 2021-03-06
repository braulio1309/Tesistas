<?php require_once 'includes/conexion.php';

	$id = isset($_GET['id'])?$_GET['id']:null;

	// SI EXISTE LA CEDULA DE PROFESOR SE OBTIENEN TODOS LOS DATOS DEL PROFESOR
    if($id){
        $sql = "SELECT * FROM profesores WHERE cedula_profe = '$id' ";
        $profesor=pg_Exec($db,$sql);

    }
    
	// SI PRESION EL BOTON DE ACTUALIZAR DATOS SE GUARDAN LOS DATOS EN UNA VARIABLA
	if (isset($_POST["rt"])){
        $nombre = $_POST ["nombre"];
        $id     = $_POST ["id"];
        $tlf    = $_POST ["tlf"];
        $correo = $_POST ["correo"];
		$dir    = $_POST ["dir"];
	
		// ACTUALIZA LOS DATOS DEL PROFESOR
		$sql="UPDATE 
                profesores 
              SET 
                nombreProfe ='$nombre', telefonoProfe = '$tlf', correoProfe = '$correo', direccionProfe = '$dir' 
               WHERE 
                cedula_profe ='$id' ";
        
        $profesor=pg_Exec($db,$sql);
		
		if($profesor==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_p.php");
		}

	} 

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>Actualizar Profesor</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="nombre">Nombre</label>
						<input type="text" autofocus name="nombre" class="form-control" value="<?=pg_result($profesor, 0, 1)?>" >
					</div>
					<div class="form-group">
						<label for="" src="id">Cedula</label>
						<input type="text" name="id" class="form-control" value="<?=pg_result($profesor, 0, 0)?>" readonly>
					</div>
					<div class="form-group">
						<label for="" src="tlf">Numero telefono</label>
						<input type="text"  name="tlf" class="form-control" value="<?=pg_result($profesor, 0, 3)?>" id="tlf" >
					</div>
					<div class="form-group">
						<label for="" src="correo">Correo Particular</label>
						<input type="email"  name="correo" value="<?=pg_result($profesor, 0, 4)?>" class="form-control" id="correo" >
					</div>
					<div class="form-group">
						<label for="" src="dir">Ubicacion</label>
						<input type="text" name="dir" class="form-control" value="<?=pg_result($profesor, 0, 2)?>" id="dir" >
					</div>

					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Actualizar Profesor">
                    <a href="eliminar_p.php?id=<?=pg_result($profesor, 0, 0)?>"><input class="btn btn-danger"type="button" value="Borrar"></a>
                </div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->

<?php require_once 'includes/lateral.php'; ?>
	
<?php require_once 'includes/pie.php'; ?>