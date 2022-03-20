<?php session_start();
// error_reporting(0);

header('Content-type: application/json; charset=utf-8');
$conexion = new mysqli('localhost','root','','ceprevi');


$aula="C-101";
if ($conexion->connect_errno) {
	$respuesta = [
		'error' => true
	];
}else{
	$conexion->set_charset("utf8");
	$statement = $conexion->prepare('SELECT *FROM alumno WHERE aula="'.$aula.'"');
	$statement->execute();
	$resultado = $statement->get_result();

	$respuesta = [];

	while ($fila = $resultado->fetch_assoc()) {
		$usuario = [
			'id'		=>$fila['codigo'],
			'nombres'	=>$fila['a_paterno'],
			'edad'		=>$fila['a_materno'],
			'pais'		=>$fila['nombres'],
			'correo'	=>$fila['carrera']
		];
		array_push($respuesta, $usuario);
	}
}

echo json_encode($respuesta);

?>


