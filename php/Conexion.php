<?php
define("DB_HOST","sql180.main-hosting.eu"); 
define("DB_USER", "u544169841_storeelectroni"); 
define("DB_PASS", "storeelectronica");
define("DB_DATABASE", "u544169841_storeelectroni" ); 
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if($conexion -> connect_errno){
    die("Error de conexión: " . $conexion->mysqli_connect_errno() . ", " . $conexion->connect_error());
	exit();
}
?>