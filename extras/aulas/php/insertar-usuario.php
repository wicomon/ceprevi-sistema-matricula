<?php 
header('Content-type: application/json; charset=utf-8');
$nombre = $_POST['nombre'];
$numero = $_POST['numero'];
$capacidad = $_POST['capacidad'];
$pabellon = $_POST['pabellon'];
$turno = $_POST['turno'];
$sede = $_POST['sede'];
$ciclo = $_POST['ciclo'];

function validarDatos($nombre, $numero, $pabellon, $sede){
    return true;
}

if(validarDatos($nombre, $numero, $pabellon, $sede)){
    $conexion = new mysqli('localhost', 'root', 'ceprevi2020', 'ceprevi');
	$conexion->set_charset('utf8');

    if ($conexion->connect_errno) {
        $respuesta = ['error' => true];
    }else {
        $statement = $conexion->prepare("INSERT INTO aulas(nombre, numero, capacidad, pabellon, turno, sede, ciclo) VALUES(?,?,?,?,?,?,?)");
		$statement->bind_param("siissss", $nombre, $numero, $capacidad, $pabellon,$turno,$sede,$ciclo);
		$statement->execute();

        if($conexion->affected_rows <= 0){
			$respuesta = ['error' => true];
		}

		$respuesta = [];
	}
}else {
    $respuesta = ['error' => true];
}

echo json_encode($respuesta);

?>