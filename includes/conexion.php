<?php
// Conexión
$servidor = '127.0.0.1';
$usuario = 'root';
$password = '';
$basededatos = 'sistema_automatizado'; //Pon el nombre de la base de datos
$db = pg_connect("host=127.0.0.1 port=5433  dbname=sistema_automatizado user=postgres  password=1234");

//mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}