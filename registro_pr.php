<?php require_once 'includes/conexion.php';

	if (isset($_POST["rt"])){
		$cedula1=$_POST["cedula1"];
		$cedula2=$_POST["cedula2"];
		$titulo=$_POST["titulo"];
		$nombreTutor=$_POST["nombreTutor"];
		$nombreEmpresa=$_POST["nombreEmpresa"];
        $experimental=$_POST["experimental"];
        //Condiciones para ver si es experimental o no
        //Recordar guardar las cedulas del tesista e id de propuesta en otra tabla
		/*$sql="INSERT INTO tesistas(cedula, nombre, correo_ucab, correo_part, telefono, sexo) VALUES ('$cedula','$nombre','$correo_ucab','$correo_part','$telefono','$sexo')";
		$tesista=mysqli_query($db,$sql);

		if($tesista==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}*/

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
    input.placeholder = "Cédula del profesor que avala"

    
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
     input.name='NombreEmpresa';
     input.placeholder ="Nombre de la empresa";
 
     descripcion.type = 'text';
     descripcion.name = 'NombreTutor';
     descripcion.placeholder="Nombre del tutor empresarial";
     descripcion.class='form-control col-sm-10';
 
     
     div.appendChild(input);
     div.appendChild(descripcion);
     padre.appendChild(div);
   } 

   
  
</script>
<?php require_once 'includes/lateral.php'; ?>
	
<?php require_once 'includes/pie.php'; ?>