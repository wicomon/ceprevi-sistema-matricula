<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

	$sentencia1 = $conexion->prepare("SELECT *FROM especialidades ORDER BY especialidad");
	$sentencia1->execute();
	$posts1 = $sentencia1->fetchAll();

	
	$sentencia2 = $conexion->prepare("SELECT DISTINCT sede FROM alumno ORDER BY sede");
	$sentencia2->execute();
	$posts2 = $sentencia2->fetchAll();


	$statement = $conexion->prepare("SELECT * FROM alumno WHERE codigo=:codigo");
	$statement->execute(array(':codigo'=>$_GET['cod']));
	$posts = $statement->fetch();
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
	$descuento = $_POST['descuento'];


	$statement1 = $conexion->prepare('UPDATE alumno SET  sede=:sede, turno=:turno, aula=:aula,ciclo=:ciclo, a_paterno=:a_paterno,a_materno=:a_materno,nombres=:nombres,dni=:dni,carrera=:carrera,sexo=:sexo,descuento=:descuento  WHERE codigo =:codigo');
	$statement1->execute(array(':codigo'=>$codigo,':sede'=>$sede,':turno'=>$turno,':aula'=>$aula,':ciclo'=>$ciclo, ':a_paterno'=>utf8_decode($paterno), ':a_materno'=>utf8_decode($materno),':nombres'=>utf8_decode($nombres),':dni'=>$dni,':carrera'=>$carrera,':sexo'=>$sexo,':descuento'=>$descuento));

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/editar_alumno.view.php';
?>