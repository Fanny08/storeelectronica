<?php
include('../Conexion.php');
include('../Funciones.php');

$obj = new stdClass();
$consulta = $conexion -> query("SELECT Id, Nombre, Estrellas, Precio, Stock, Descripcion FROM Productos");
while($fila = $consulta -> fetch_assoc()) {
	
	$imagenes = [];
	
	$imagenesSQL = $conexion -> query("SELECT Nombre FROM Imagenes WHERE Productos_id = {$fila['Id']}");
	while($filaImagenes = $imagenesSQL -> fetch_assoc()) {
		array_push($imagenes, $filaImagenes['Nombre']);
	}
	
	$obj -> productos[] =
	[
		"id" => $fila['Id'],
		"nombre" => $fila['Nombre'],
		"estrellas" => $fila['Estrellas'],
		"precio" => $fila['Precio'],
		"stock" => $fila['Stock'],
		"descripcion" => $fila['Descripcion'],
		"imagenes" => $imagenes
	];
}

echo json_encode($obj);
?>