<?php session_start();

require 'admin/config.php';
require 'funciones.php';
require_once 'models/Alumno.php';
require_once 'models/Economico.php';

$model_economico = new Economico();
$model_alumno = new Alumno();




	// $statement = $conexion->prepare("SELECT * FROM economico WHERE liquidacion=:liquidacion");
	// $statement->execute(array(':liquidacion'=>$_GET['cod']));
	$posts = $model_economico->buscar_por_liquidacion($_GET['cod']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Limpiamos los datos para evitar que el usuario inyecte codigo.
	$codigo = $_POST['codigo'];
	$nombres = $_POST['nombres'];
	$nro_recibo = $_POST['nro_recibo'];
	$liquidacion = $_POST['liquidacion'];
	$fecha = $_POST['fecha'];
	$monto = $_POST['monto'];
	$ciclo = $_POST['ciclo'];
	

	$model_economico->editar_pago($codigo,$nombres,$nro_recibo,$liquidacion,$fecha,$monto,$ciclo);

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/editar_pago.view.php';
?>