<?php

function mostrarError($errores, $campo){
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}
	
	return $alerta;
}

function borrarErrores(){
	$borrado = false;
	
	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}
	
	return $borrado;
}


// número 2 de la asignación
function clientesRetirados($db){
	$sql = "SELECT num_cliente, nombre, direccion, fecha_afiliacion 
	FROM cliente 
	WHERE estatus='Retirado' 
	AND fecha_afiliacion='2019' 
	ORDER BY fecha_afiliacion ASC;";
	//var_dump($db);die();
	$clientes = mysqli_query($db, $sql);
	
	$resultado = array();
	if($clientes && mysqli_num_rows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}
//número 3 
function ClientesPeliculas($fecha_inicial, $fecha_final){
	$sql = "SELECT cliente.num_cliente, cliente.cedula, cliente.nombre 
	FROM cliente, prestamo 
	WHERE prestamo.codigo_numcliente = cliente.num_cliente 
	AND prestamo.fecha_prestamo 
	BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY cliente.cedula;";
	$clientes = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($clientes && mysqli_num_rows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}

//número 4 
function estudiosPeliculas(){
	$sql = "SELECT DISTINCT estudio.idestudio, estudio.nombre_estudio, COUNT(estudio.idestudio) AS TotalPeliculas 
	FROM estudio 
	WHERE estudio.idestudio = (SELECT cod_idestudio FROM pelicula ) 
	ORDER BY TotalPeliculas DESC;";
	$estudios = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($estudios && mysqli_num_rows($estudios) >= 1){
		$resultado = $estudios;
	}
	
	return $resultado;
}

//número 5
function clientesAlquiler(){
	$sql = "SELECT cliente.num_cliente, cliente.nombre, pelicula.idpelicula, pelicula.titulo, prestamo.fecha_prestamo, estudio.nombre_estudio 
	FROM cliente, pelicula, prestamo, estudio 
	WHERE (estudio.nombre_estudio = 'Universal Estudios' OR estudio.nombre_estudio = 'Paramaut Picture') 
	AND prestamo.fecha_prestamo = '2019' 
	ORDER BY cliente.num_cliente, pelicula.idpelicula;";
	$clientes = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($clientes && mysqli_num_rows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}

//número 6
function peliculas(){
	$sql = "SELECT DISTINCT pelicula.idpelicula, pelicula.titulo, pelicula.fecha_desincorporacion, COUNT(prestamo.cod_idpelicula) AS TotalAlquiladas 
	FROM pelicula, prestamo, estudio 
	WHERE (estudio.nombre_estudio = 'Disney Studios' OR estudio.nombre_estudio = 'Disney Pixar') 
	AND pelicula.fecha_desincorporacion IS NOT NULL;";
	$peliculas = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($peliculas && mysqli_num_rows($peliculas) >= 1){
		$resultado = $peliculas;
	}
	
	return $resultado;
}

//número 7
function clientesActivos(){
	$sql = "SELECT DISTINCT cliente.num_cliente, cliente.nombre, COUNT(prestamo.cod_idpelicula) AS TotalAlquiladas 
	FROM cliente, pelicula, prestamo 
	HAVING TotalAlquiladas>5 
	ORDER BY TotalAlquiladas DESC;";
	$clientes = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($clientes && mysqli_num_rows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}

//número 8
function actualizarEstatus(){
	$sql = "UPDATE prestamo SET prestamo.estatusp = 'CD' 
	WHERE prestamo.fecha_devolucion < (prestamo.fecha_prestamo+prestamo.dias_prestamos) ;";
	$editar = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($editar && mysqli_num_rows($editar) >= 1){
		$resultado = $editar;
	}
	
	return $resultado;
}

//número 8
function eliminar(){
	$sql = "DELETE FROM cliente WHERE estatus = 'Retirado';";
	$eliminar = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($eliminar && mysqli_num_rows($eliminar) >= 1){
		$resultado = $eliminar;
	}
	
	return $resultado;
}

