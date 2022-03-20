<?php session_start();

require 'funciones.php';
require_once 'models/Especialidad.php';
require_once 'models/Sedes.php';
require_once 'models/Alumno.php';

verificarPrivilegios($_SESSION['privilegios']);

$error_insert=false;
$conexion = new Especialidad();
	$especialidades = $conexion->listar_especialidades();

	$conexion2 = new Sedes();
	$sedes = $conexion2->listar_sedes();

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

	$model_alumno = new Alumno();
	$insert_alumno = $model_alumno->insertar_alumno($codigo,$dni,$carrera,$nombres,$paterno,$materno,$sexo,$turno,$aula,$ciclo,$sede);

	if ($insert_alumno > 0) {
		header('Location: menu.php');
	}else{
		$error_insert = true;
	}
	
	
	
}

require 'header.php';
require 'views/agregar_alumno.view.php';
?>