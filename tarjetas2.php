<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

$resultado = traerDatos();

$sentencia1 = $conexion->prepare("SELECT DISTINCT ciclo FROM alumno");
$sentencia1->execute();
$posts1 = $sentencia1->fetchAll();
	
if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE aula=:aula AND ciclo=:ciclo  ORDER BY a_paterno,a_materno,nombres");
	$sentencia->execute(array(':aula'=>$_POST['aula'],':ciclo'=>$_POST['sciclo']));
	$posts = $sentencia->fetchAll();

}

require 'header.php';

require 'views/tarjetas2.view.php';

?>

