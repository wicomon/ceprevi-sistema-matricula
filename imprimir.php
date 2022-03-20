<?php session_start();

require 'admin/config.php';
require 'funciones.php';
require_once 'models/Ciclo.php';
require_once 'models/Sedes.php';
require_once 'models/Alumno.php';
require_once 'models/Economico.php';

$model_ciclo = new Ciclo();
$model_sedes = new Sedes();
$model_alumno = new Alumno();
$model_economico = new Economico();

$resultado = traerDatos();

	$posts1 = $model_ciclo->listar_ciclos_alumnos();

	$posts2 = $model_sedes->listar_sedes_ciclo('2019-C');

	
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['deuda']=='color') {
		$a='COLOR';
		// $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:aula AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
		// $sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
		$alumno = $model_alumno->alumnos_por_sede_ciclo($_POST['aula'],$_POST['sciclo']);

		// $sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
		// $sentencia2->execute(array(':ciclo'=>$_POST['sciclo']));
		$economico = $model_economico->listado_por_ciclo($_POST['sciclo']);
	}
	if ($_POST['deuda']=='blanca') {
		$a='BLANCA';
		// $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:aula AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
		// $sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
		$alumno = $model_alumno->alumnos_por_sede_ciclo($_POST['aula'],$_POST['sciclo']);

		// $sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
		// $sentencia2->execute(array(':ciclo'=>$_POST['sciclo']));
		$economico = $model_economico->listado_por_ciclo($_POST['sciclo']);
	}
	

}


require 'header.php';

require 'views/imprimir.view.php';

?>
