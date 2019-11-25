<?php
$obj = new stdClass();

$carrito = array();

if(isset($_COOKIE['carrito']))
{	
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
		"code" => 4
	];
}

echo json_encode($obj);
?>