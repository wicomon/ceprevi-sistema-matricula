<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

	$sentencia1 = $conexion->prepare("SELECT DISTINCT ciclo FROM alumno ORDER BY sede,aula");
	$sentencia1->execute();
	$posts1 = $sentencia1->fetchAll();

	$sentencia3 = $conexion->prepare("SELECT DISTINCT sede FROM alumno ");
	$sentencia3->execute();
	$posts3 = $sentencia3->fetchAll();

	
if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:sede AND ciclo=:ciclo  ORDER BY sede,aula,a_paterno,a_materno,nombres");
		$sentencia->execute(array(':sede'=>$_POST['sede'],':ciclo'=>$_POST['sciclo']));
		$posts = $sentencia->fetchAll();

		$sentencia1 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo  ORDER BY codigo");
		$sentencia1->execute(array(':ciclo'=>$_POST['sciclo']));
		$posts2 = $sentencia1->fetchAll();

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
