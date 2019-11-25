<?php
include('../Funciones.php');
$carrito = array();
$obj = new stdClass();

$idCookie = filter_var($_POST['idCookie'],FILTER_SANITIZE_NUMBER_INT);

if(vacio($idCookie))
{
	//Return elementos del carrito
	if(isset($_COOKIE['carrito']))
	{
		$carrito = unserialize($_COOKIE['carrito']);
		
		unset($carrito[$idCookie]);
		
		//Creamos la cookie (serializamos)
		$iTemCad = time() + (60 * 60);
		setcookie('carrito', serialize($carrito), $iTemCad);
	}
	
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