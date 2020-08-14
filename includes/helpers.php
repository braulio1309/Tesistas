<?php

// CONSULTA PARA MOSTRAR TODOS LOS TESISTAS
function mostrarTesistas($conexion){
	$sql="SELECT * FROM tesistas";
	$clientes = pg_Exec($conexion, $sql);
	
	$resultado = array();
	if($clientes && pg_NumRows($clientes) >= 1){
		$resultado = $clientes;
	}
	
	return $resultado;
}

// CONSULTA PARA ELIMINAR UN TESISTA ESPECIFICADO POR CEDULA 
function eliminarTesista($id){
	$sql = "DELETE FROM tesista WHERE cedula = {$id};";
	$eliminar = pg_Exec($conexion, $sql);
	
	$resultado = array();
	if($eliminar && pg_NumRows($eliminar) >= 1){
		$resultado = $eliminar;
	}
	
	return $resultado;
}

