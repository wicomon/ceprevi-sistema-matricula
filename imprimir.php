<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

	$sentencia1 = $conexion->prepare("SELECT DISTINCT ciclo FROM alumno ORDER BY sede,aula");
	$sentencia1->execute();
	$posts1 = $sentencia1->fetchAll();

	$sentencia2 = $conexion->prepare("SELECT DISTINCT sede FROM alumno WHERE ciclo='2019-C'");
	$sentencia2->execute();
	$posts2 = $sentencia2->fetchAll();

	
if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['deuda']=='color') {
		$a='COLOR';
		$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:aula AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
		$sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
		$alumno = $sentencia->fetchAll();

		$sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
		$sentencia2->execute(array(':ciclo'=>$_POST['sciclo']));
		$economico = $sentencia2->fetchAll();
	}
	if ($_POST['deuda']=='blanca') {
		$a='BLANCA';
		$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:aula AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
		$sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
		$alumno = $sentencia->fetchAll();

		$sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
		$sentencia2->execute(array(':ciclo'=>$_POST['sciclo']));
		$economico = $sentencia2->fetchAll();
	}
	

}


require 'header.php';

require 'views/imprimir.view.php';

?>
