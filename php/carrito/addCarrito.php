<?php 
include('../Funciones.php');

$carrito = array();
$obj = new stdClass();

$id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
$imagen = filter_var($_POST['imagen'],FILTER_SANITIZE_STRING);
$nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
$precio = filter_var($_POST['precio'],FILTER_SANITIZE_NUMBER_FLOAT);

if(vacio($id) && vacio($imagen) && vacio($nombre) && vacio($precio))
{
	//Return elementos del carrito
	if(isset($_COOKIE['carrito']))
	{
		$carrito = unserialize($_COOKIE['carrito']);
	}	
	
	//Añadir al carrito
	$UltimaPos = count($carrito);
	$carrito[$UltimaPos]['id'] = $id;
	$carrito[$UltimaPos]['imagen'] = $imagen;
	$carrito[$UltimaPos]['nombre'] = $nombre;
	$carrito[$UltimaPos]['precio'] = $precio;
	
	//Creamos la cookie (serializamos)
	$iTemCad = time() + (60 * 60);
	setcookie('carrito', serialize($carrito), $iTemCad);
	
	$obj -> status[] =
	[
		"code" => 2
	];
}
else
{
	$obj -> status[] =
	[
		"code" => 5
	];
}

echo json_encode($obj);

?>