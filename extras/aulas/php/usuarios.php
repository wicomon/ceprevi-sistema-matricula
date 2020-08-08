<?php 
header('Content-type: application/json; charset=utf-8');

$respuesta=[
	[
		'_id'=> '31431431431',
		'nombre' => 'carlos',
		'edad' => 23,
		'pais' => 'Peru',
		'correo' => 'carlos@correo.com'
	],
	[
		'_id'=> '314314322212',
		'nombre' => 'williams',
		'edad' => 23,
		'pais' => 'Perusalen',
		'correo' => 'carlos@correo.com'
	],
];

echo json_encode($respuesta);

//echo '[{"nombre": "carlos" }, {"nombre": "alejandro"}]';

 ?>