<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/braulio.php'; ?>
<?php require_once 'includes/comprobar_login.php';?>

<?php
	require_once 'includes/conexion.php';
	
    $id = $_GET['id'];
    
    $sql = "SELECT 
                e.id_especialidad, e.nombreEspecialidad 
            FROM 
                especialidades e, profesores p, tiene t 
            WHERE 
                p.cedula_Profe = t.cedula_Profe AND 
                e.id_especialidad = t.cod_especialidad AND
                p.cedula_profe = '$id'";
	$especialidad = pg_Exec($db,$sql);
    
    $sql = "SELECT 
                nombreProfe 
            FROM 
                profesores 
            WHERE 
                cedula_profe ='$id'";
	$profesor = pg_Exec($db,$sql);
	$filas = pg_NumRows($especialidad);


    $entradas = array();
	$entradas = $especialidad;
    if (isset($_POST["at"])){
		$cedula=$_POST["cedula"];
		$nombre=$_POST["nombre"];
		$correo_ucab=$_POST["correo_ucab"];
		$correo_part=$_POST["correo_part"];
		$telefono=$_POST["telefono"];
        $sexo=$_POST["sexo"];

		$sql="UPDATE tesistas SET nombre='$nombre' , correo_ucab='$correo_ucab', correo_part='$correo_part', telefono='$telefono', sexo='$sexo'
			   WHERE cedula='$cedula'";

		$tesista=pg_Exec($db,$sql);

		if($tesista==false){
			var_dump('Error en la consulta');
		}else{
			header("Location:Mostrar_t.php");
		}

	}

?>
		
<!-- CAJA PRINCIPAL -->
<div class="container">
    
	<div class="container">
		<h1>Especialidades de prof. <?=pg_result($profesor, 0, 0)?></h1>
        <div class="row">
            
            <div class="col-sm-4">
                <a href="asignar_e.php?id=<?=$id?>" class="btn btn-primary">Nueva especialidad</a>
            </div>
        </div>
        
        <br>
		<table class="table">
		   <thead>
				<th>ID</th>
				<th>Nombre especialidad</th>
				
		    </thead>		
			<tbody>
				<?php 
					
					if(!empty($especialidad)):
						for ($j=0; $j < $filas; $j++):
							?>
							<tr>
							<td> <?= pg_result($especialidad, $j, 0) ?> </td>	
							<td> <?= pg_result($especialidad, $j, 1)?> </td>
                           
							</tr>
				<?php
						endfor;
					endif;
					
					?>
			</tbody>
		</table>
	</div>
</div> <!--fin principal-->
<?php require_once 'includes/pie.php'; ?>