<?php 
error_reporting(0);

header('Content-type: application/json; charset=utf-8');
$conexion = new mysqli('localhost','root','ceprevi2020','ceprevi');

if ($conexion->connect_errno) {
	$respuesta = [
		'error' => true
	];
}else{
	$conexion->set_charset("utf8");
	$statement = $conexion->prepare("SELECT *FROM aulas ORDER BY numero");
	$statement->execute();
	$resultado = $statement->get_result();
	
	$respuesta = [];

	while ($fila = $resultado->fetch_assoc()) {
		$usuario = [
			'ID'		=>$fila['ID'],
			'nombre'		=>$fila['nombre'],
			'numero'	=>$fila['numero'],
			'capacidad'		=>$fila['capacidad'],
			'pabellon'		=>$fila['pabellon'],
			'turno'		=>$fila['turno'],
			'sede'		=>$fila['sede'],
			'ciclo'	=>$fila['ciclo']
		];
		array_push($respuesta, $usuario);
	}
}

echo json_encode($respuesta);





 ?>