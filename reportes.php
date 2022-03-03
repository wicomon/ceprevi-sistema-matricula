<?php session_start();

require 'funciones.php';
require_once 'models/Ciclo.php';
require_once 'models/Sedes.php';
require_once 'models/Alumno.php';

$model_ciclo = new Ciclo();
$model_sedes = new Sedes();
$model_alumno = new Alumno();


	$posts1 = $model_ciclo->listar_ciclos_alumnos();

	$posts3 = $model_sedes->listar_sedes_alumnos();

	
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$posts = $model_alumno->alumnos_ordenadosXsede($_POST['sciclo']);

}


require 'header.php';

require 'views/reportes.view.php';

?>
