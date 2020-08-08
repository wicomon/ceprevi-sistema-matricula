<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

	$sentencia1 = $conexion->prepare("SELECT * FROM especialidades ORDER BY especialidad");
	$sentencia1->execute();
	$posts1 = $sentencia1->fetchAll();

	$sentencia2 = $conexion->prepare("SELECT DISTINCT sede FROM sedes ORDER BY id");
	$sentencia2->execute();
	$posts2 = $sentencia2->fetchAll();

	/*$sentencia = $conexion->prepare("SELECT * FROM asistencia INNER JOIN alumno ON asistencia.codigo=alumno.codigo WHERE asistencia.codigo=:codigo AND asistencia.fecha=:fecha ");
	$sentencia->execute(array(':codigo'=>$_GET['cod'],':fecha'=>$_GET['fecha']));
	$posts = $sentencia->fetch();*/


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Limpiamos los datos para evitar que el usuario inyecte codigo.
	$codigo = $_POST['codigo'];
	$dni = $_POST['dni'];
	$carrera = $_POST['carrera'];
	$nombres = $_POST['nombres'];
	$paterno = $_POST['paterno'];
	$materno = $_POST['materno'];
	$sexo = $_POST['sexo'];
	$turno = $_POST['turno'];
	$aula = $_POST['aula'];
	$ciclo = $_POST['ciclo'];
	$sede = $_POST['sede'];

	$statement = $conexion->prepare('INSERT INTO alumno (codigo, sede,turno, aula,ciclo, a_paterno,a_materno,nombres,dni,carrera,sexo) VALUES (:codigo, :sede,:turno, :aula,:ciclo, :a_paterno,:a_materno,:nombres,:dni,:carrera,:sexo)');
	$statement->execute(array(':codigo'=>$codigo,':sede'=>$sede,':turno'=>$turno,':aula'=>$aula,':ciclo'=>$ciclo, ':a_paterno'=>$paterno, ':a_materno'=>$materno,':nombres'=>$nombres,':dni'=>$dni,':carrera'=>$carrera,':sexo'=>$sexo));
	header('Location: menu.php');
	
	
}

require 'header.php';
require 'views/agregar_alumno.view.php';
?>