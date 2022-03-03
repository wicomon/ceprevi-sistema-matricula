<?php session_start();

require 'funciones.php';

$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once 'models/Alumno.php';

	$conexion = new Alumno();

	if ($_POST['paterno']=='' AND $_POST['materno']!=='' ) {
		$posts = $conexion->alumnos_por_amaterno($_POST['materno']);
	}

	if ($_POST['paterno']==!'' AND $_POST['materno']=='' ) {
		$posts = $conexion->alumnos_por_apaterno($_POST['paterno']);
	}
	if ($_POST['paterno']!=='' AND $_POST['materno']!=='' ) {
		$posts = $conexion->alumnos_por_apellidos($_POST['paterno'], $_POST['materno']);
	}

	if ($_POST['paterno']=='' AND $_POST['materno']=='' ) {
		
		$mensaje = 'No hay datos que mostrar';
	}

}


require 'header.php';

require 'views/alumnos.view.php';

?>

