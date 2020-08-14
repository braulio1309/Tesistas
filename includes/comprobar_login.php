<!-- DETECTA SI UN USUARIO DEL SISTEMA INICIO SESION, SI NO DETECTA LO REDIRIGE A INICIAR SESION -->
<?php
    if(!isset($_SESSION["usuario"])){
        header("Location:login.php");
    }

?>