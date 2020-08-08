<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

	$sentencia1 = $conexion->prepare("SELECT DISTINCT ciclo FROM alumno ORDER BY ciclo");
	$sentencia1->execute();
	$posts1 = $sentencia1->fetchAll();

	$sentencia2 = $conexion->prepare("SELECT DISTINCT aula FROM alumno WHERE ciclo='2019-C'");
	$sentencia2->execute();
	$posts2 = $sentencia2->fetchAll();

	
if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}


require 'header.php';
require 'views/pre_asistencia.view.php';
?>

