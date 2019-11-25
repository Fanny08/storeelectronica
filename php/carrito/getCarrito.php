<?php 
$carrito = array();
$obj = new stdClass();
$productos = 0;
$subtotal = 0;

//Return elementos del carrito
if(isset($_COOKIE['carrito']))
{
	$carrito = unserialize($_COOKIE['carrito']);
}
else
{
	$obj -> status[] =
	[
		"code" => 5
	];
}

//Recorrido del carrito
foreach ($carrito as $key => $value)
{	
	$obj -> productos[] =
	[
		"idCookie" => $key,
		"id" => $value['id'],
		"imagen" => $value['imagen'],
		"nombre" => $value['nombre'],
		"precio" => $value['precio']
	];
	$productos += 1;
	$subtotal += $value['precio'];
}

$obj -> total[] =
[
	"productos" => $productos,
	"subtotal" => $subtotal
];

echo json_encode($obj);

?>