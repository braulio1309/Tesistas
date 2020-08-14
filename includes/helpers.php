<?php

// CONSULTA PARA MOSTRAR TODOS LOS TESISTAS
function mostrarTesistas($conexion){
	$sql="SELECT * FROM tesistas";
	$clientes = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($clientes && mysqli_num_rows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}

// CONSULTA PARA ELIMINAR UN TESISTA ESPECIFICADO POR CEDULA 
function eliminarTesista($id){
	$sql = "DELETE FROM tesista WHERE cedula = {$id};";
	$eliminar = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($eliminar && mysqli_num_rows($eliminar) >= 1){
		$resultado = $eliminar;
	}
	
	return $resultado;
}

