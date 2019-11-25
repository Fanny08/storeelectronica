<?php
include('Conexion.php');

//Consulta sin parametros
if($conexion -> query("TRUNCATE TABLE Respuestas")){
	echo 'Realizada consulta SIN parametros <br><br>';
}

//Consulta con parametros
$Usuario = 5000003;
$Correo = "luisacxis@gmail.com";
$consulta = $conexion -> prepare("DELETE FROM Usuarios WHERE Correo = ? AND Usuario = ?");
$consulta -> bind_param("si", $Correo,$Usuario);
if($consulta -> execute()){
	echo 'Realizada consulta CON parametros <br><br>';
}


//Consulta sin parametros y return Resultado
echo 'Consulta SIN parametros CON return <br>';
$consulta = $conexion -> query("SELECT Usuario as User, Nombre, Correo, Curp FROM Usuarios");
while($fila = $consulta -> fetch_assoc()) {
	echo
	"
		Usuario: {$fila['User']} <br>
		Nombre: {$fila['Nombre']} <br>
		Correo: {$fila['Correo']} <br>
		Curp: {$fila['Curp']} <br><br>
	";
}

//Consulta con parametros y return resultado
echo 'Consulta CON parametros CON return <br>';
$Nombre = 'Luis Manuel';
$consulta = $conexion -> prepare("SELECT Usuario, Nombre, Correo, Curp FROM Usuarios WHERE Nombre = ?");
$consulta -> bind_param("s", $Nombre);
$consulta -> execute();
$result = $consulta -> get_result();
while ($fila = $result -> fetch_assoc()) {
	echo
	"
		Usuario: {$fila['Usuario']} <br>
		Nombre: {$fila['Nombre']} <br>
		Correo: {$fila['Correo']} <br>
		Curp: {$fila['Curp']} <br><br>
	";
}

?>