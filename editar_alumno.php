<?php session_start();

require 'funciones.php';
require_once 'models/Alumno.php';
require_once 'models/Especialidad.php';
require_once 'models/Sedes.php';

verificarPrivilegios($_SESSION['privilegios']);

$model_alumno = new Alumno();
$model_sedes = new Sedes();
$model_especialidades = new Especialidad();
$error_insert=false;

	$posts1 = $model_especialidades->listar_especialidades();

	
	$posts2 = $model_sedes->listar_sedes_alumnos();


	$posts = $model_alumno->buscar_alumno($_GET['cod']);
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


	$insert_alumno = $model_alumno->actualizar_alumno($codigo,$dni,$carrera,$nombres,$paterno,$materno,$sexo,$turno,$aula,$ciclo,$sede,$descuento);

	if ($insert_alumno > 0) {
		header('Location: menu.php');
	}else{
		$error_insert = true;
	}
	

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/editar_alumno.view.php';
?>