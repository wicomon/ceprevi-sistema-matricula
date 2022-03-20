<?php session_start();

require 'funciones.php';
require_once 'models/Ciclo.php';
require_once 'models/Alumno.php';

$model_alumno = new Alumno();

$model_ciclo = new Ciclo();


$resultado = traerDatos();

// $sentencia1 = $conexion->prepare("SELECT DISTINCT ciclo FROM alumno");
// $sentencia1->execute();
$posts1 = $model_ciclo->listar_ciclos_alumnos();
	
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE aula=:aula AND ciclo=:ciclo  ORDER BY a_paterno,a_materno,nombres");
	// $sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
	$posts = $model_alumno->alumnos_por_aula_ciclo($_POST['aula'],$_POST['sciclo']);

}

require 'header.php';

require 'views/tarjetas2.view.php';

?>

