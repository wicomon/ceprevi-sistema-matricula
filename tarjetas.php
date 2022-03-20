<?php session_start();

require 'funciones.php';
require_once 'models/Ciclo.php';
require_once 'models/Alumno.php';

$model_ciclo = new Ciclo();
$model_alumno = new Alumno();


	$posts1 = $model_ciclo->listar_ciclos_alumnos();
	
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$posts = $model_alumno->alumnos_por_aula_ciclo($_POST['aula'],$_POST['sciclo']);

	

}


require 'header.php';

require 'views/tarjetas.view.php';

?>

