<?php session_start();
error_reporting(0);
require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sentencia = $conexion->prepare("SELECT * FROM asistencia INNER JOIN alumno ON asistencia.codigo=alumno.codigo WHERE asistencia.codigo=:codigo ORDER BY fecha ");
	$sentencia->execute(array(':codigo'=>$_POST['codigo']));
	$posts = $sentencia->fetchAll();
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sentencia = $conexion->prepare("SELECT * FROM asistencia INNER JOIN alumno ON asistencia.codigo=alumno.codigo WHERE asistencia.codigo=:codigo ORDER BY fecha ");
	$sentencia->execute(array(':codigo'=>$_GET['codigo']));
	$posts = $sentencia->fetchAll();
}



require 'header.php';

require 'views/editar_asistencia.view.php';

?>

