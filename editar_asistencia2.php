<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);



	$sentencia = $conexion->prepare("SELECT * FROM asistencia INNER JOIN alumno ON asistencia.codigo=alumno.codigo WHERE asistencia.codigo=:codigo AND asistencia.fecha=:fecha ");
	$sentencia->execute(array(':codigo'=>$_GET['cod'],':fecha'=>$_GET['fecha']));
	$posts = $sentencia->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Limpiamos los datos para evitar que el usuario inyecte codigo.
	$codigo = $_POST['codigo'];
	$aula = $_POST['aula'];
	$fecha = $_POST['fecha'];
	$dia = $_POST['dia'];
	$mes = $_POST['mes'];
	$year = $_POST['year'];
	$estado = $_POST['estado'];

	$statement = $conexion->prepare('UPDATE asistencia SET  estado = :estado WHERE codigo = :codigo AND fecha=:fecha');
	$statement->execute(array(':codigo' => $codigo,':fecha' => $fecha,':estado' => $estado));
	header('Location: editar_asistencia.php?codigo='.$codigo);
	
}

require 'header.php';
require 'views/editar_asistencia2.view.php';
?>