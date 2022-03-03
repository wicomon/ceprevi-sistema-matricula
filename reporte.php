<?php session_start();


require 'funciones.php';
require_once 'models/Ciclo.php';
require_once 'models/Sedes.php';
require_once 'models/Alumno.php';
require_once 'models/Economico.php';

$modelo_alumno = new Alumno();
$modelo_economico = new Economico();
$modelo_ciclo = new Ciclo();
$modelo_sedes = new Sedes();

	$posts1 = $modelo_ciclo->listar_ciclos_alumnos();


	$posts3 = $modelo_sedes->listar_sedes_alumnos();

	
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$posts = $modelo_alumno->alumnos_por_sede_ciclo($_POST['sede'],$_POST['sciclo']);

		$posts2 = $modelo_economico->listado_por_ciclo($_POST['sciclo']);

		foreach ($posts2 as $post2) {
			$codig = $post2['codigo'];
			if(!isset($total_pago[$codig])){
				$total_pago[$codig]=0;
			}
			$total_pago[$codig] = $total_pago[$codig] + $post2['monto'];

		}

}


require 'header.php';

require 'views/reporte.view.php';

?>
