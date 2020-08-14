<?php
// Conexión
$servidor = '127.0.0.1';
$usuario = 'root';
$password = '';
$basededatos = 'Sistema_Automatizado'; //Pon el nombre de la base de datos
$db = pg_connect("host=127.0.0.1 port=5432  dbname=Sistema_Automatizado user=postgres  password=pepi");

//mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}