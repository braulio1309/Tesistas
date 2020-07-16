<?php
// Conexión
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$basededatos = 'peliculas'; //Pon el nombre de la base de datos
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}