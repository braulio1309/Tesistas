<?php require_once 'includes/conexion.php';

	if (isset($_POST["rt"])){
    //Recibimos todos los valores
		$cedula1 = isset($_POST["cedula1"]) ? $_POST["cedula1"]: null;
		$cedula2 = isset($_POST["cedula2"]) ? $_POST["cedula2"]: null;
		$titulo = isset($_POST["titulo"]) ? $_POST["titulo"]: null;
		$nombreTutor = isset($_POST["nombreTutor"]) ? $_POST["nombreTutor"]: null;
		$nombreEmpresa = isset($_POST["nombreEmpresa"]) ? $_POST["nombreEmpresa"]: null;
    $experimental = isset($_POST["experimental"]) ? $_POST["experimental"]: null;

    //Tipo de propuesta
    if($experimental){
      $tipo_propuesta = 'Exp';
    }else 
      $tipo_propuesta = 'Ins';
    //Registramos la propuesta
    $propuesta = "INSERT 
    INTO 
      propuestas(num_correlativo, f_entrega_esc, f_presentacion_comite, aprobacionComite, f_aprobacion_comite, titulo, comentario, tipo_propuesta) 
    VALUES 
    (8, '2020-08-04', '2020-08-04', '2020-08-04', '2020-08-04', '$titulo', ' ', '$tipo_propuesta')";
    $propuesta = mysqli_query($db,$propuesta);

    $newPropuesta = "SELECT num_correlativo FROM propuestas ORDER BY num_correlativo DESC";
    $newPropuesta = mysqli_query($db,$newPropuesta);
    $resultado = array();

    
    $resultado = $newPropuesta;
    $resultado = mysqli_fetch_assoc($resultado);

    $correlativo = $resultado['num_correlativo'];
    //Guardamos si es experimental o instrumental
    if($experimental){

      $sql = "INSERT 
      INTO 
        experimentales(Numr_correlativo, profesorAvala) 
      VALUES 
        ('$correlativo','$experimental')";
      $propuesta = mysqli_query($db,$sql);

      
    }else{
      $sql = "INSERT 
      INTO 
        instrumentales(Nro_correlativo, nombreEmpresa, tutorEmpresarial) 
      VALUES 
        ('$correlativo','$nombreEmpresa', '$nombreTutor')";
      $propuesta = mysqli_query($db,$sql);

    }
    //Tabla presentan
    if($cedula1){
      $sql = "INSERT 
      INTO 
        presentan(cedulaTesista, nroCorrelativo) 
      VALUES 
        ('$cedula1','$correlativo')";
      $tesista = mysqli_query($db,$sql);
    }

    if($cedula2){
      $sql2 = "INSERT 
      INTO 
        presentan(cedulaTesista, nroCorrelativo) 
      VALUES 
        ('$cedula2','$correlativo')";
      $tesista2 = mysqli_query($db,$sql2);
    }
    

	

		if($tesista1==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}

	}

?>


<?php require_once 'includes/cabecera.php'; ?>
				
<?php
	
?>
<!-- CAJA PRINCIPAL -->
<div id="">
    
	<div class="container">
		<h1>REGISTRO DE TESISTA</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
			<div class="card-header">
				<div class="container">
					<div class="form-group">
						<label for="" src="cedula">Cédula del tesista 1</label>
						<input type="text" autofocus name="cedula1" class="form-control" id="cedula" >
					</div>

                    <div class="form-group">
						<label for="" src="cedula">Cédula del tesista 2</label>
						<input type="text" autofocus name="cedula2" class="form-control" id="cedula" >
					</div>

					<div class="form-group">
						<label for="" src="nombre">Título</label>
						<input type="text" name="titulo" class="form-control" id="nombre">
					</div>
                    <div class="row">
                        <label>Tipo de tesis</label>
                        <a class="btn btn-primary" href="#" onclick="experimental();">Experimental</a>
                        <a class="btn btn-primary" href="#" onclick="instrumental();">Instrumental</a>
                    </div>
                    
<br>
                    <div id="padre">
      
                    </div>

                    <div id="padre2">
      
                    </div>
					
					<div class="form-group">
					
					<input type="submit" class="btn btn-primary" name="rt" id="rt" value="Registrar Propuesta">
				</div>
			</div>
		</form>
			
	</div>
</div> <!--fin principal-->
<script>
  function experimental(){
     
    var padre = document.getElementById("padre2");
    var input = document.createElement("INPUT");  
    var div = document.createElement("div"); 
    var descripcion = document.createElement("INPUT");  
    
    div.class= 'row ';      
    input.type = 'text';
    input.class='form-control col-sm-6';
    input.name='experimental';
    input.placeholder = "Profesor que avala"

    
    div.appendChild(input);
    padre.appendChild(div);
  } 
  

  function instrumental(){
     
     var padre = document.getElementById("padre");
     var input = document.createElement("INPUT");  
     var div = document.createElement("div"); 
     var descripcion = document.createElement("INPUT");  
     var label = document.createElement("label");     
     
     div.class= 'row ';      
     input.type = 'text';
     input.class='form-control col-sm-6';
     input.name='nombreEmpresa';
     input.placeholder ="Nombre de la empresa";
 
     descripcion.type = 'text';
     descripcion.name = 'nombreTutor';
     descripcion.placeholder="Nombre del tutor empresarial";
     descripcion.class='form-control col-sm-10';
 
     
     div.appendChild(input);
     div.appendChild(descripcion);
     padre.appendChild(div);
   } 

   
  
</script>
	
<?php require_once 'includes/pie.php'; ?>