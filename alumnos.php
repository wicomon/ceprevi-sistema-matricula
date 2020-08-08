<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['paterno']=='' AND $_POST['materno']!=='' ) {
		$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_materno=:materno  ORDER BY a_materno,nombres");
		$sentencia->execute(array(':materno'=>utf8_decode($_POST['materno'])));
		$posts = $sentencia->fetchAll();
	}

	if ($_POST['paterno']==!'' AND $_POST['materno']=='' ) {
		$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_paterno=:paterno  ORDER BY a_materno,nombres");
		$sentencia->execute(array(':paterno'=>utf8_decode($_POST['paterno'])));
		$posts = $sentencia->fetchAll();
	}
	if ($_POST['paterno']!=='' AND $_POST['materno']!=='' ) {
			$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE a_paterno=:paterno AND a_materno=:materno  ORDER BY a_materno,nombres");
		$sentencia->execute(array(':paterno'=>utf8_decode($_POST['paterno']),':materno'=>utf8_decode($_POST['materno'])));
		$posts = $sentencia->fetchAll();
	}

	if ($_POST['paterno']=='' AND $_POST['materno']=='' ) {
		
		$mensaje = 'No hay datos que mostrar';
	}

}


require 'header.php';

require 'views/alumnos.view.php';

?>

