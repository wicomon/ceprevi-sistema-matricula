<?php session_start();

require 'funciones.php';

require_once 'models/Economico.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$codigo = $_POST['codigo'];
	$nombres = $_POST['nombres'];
	$nro_recibo = $_POST['nro_recibo'];
	$liquidacion = $_POST['liquidacion'];
	$fecha = $_POST['fecha'];
	$monto = $_POST['monto'];
	$ciclo = $_POST['ciclo'];

	$year = substr($fecha, 0 , 4);
	$month = substr($fecha, 5 , 2);
	$day = substr($fecha, 8 , 2);

	$resultado = $day.'/'.$month.'/'.$year;

	echo $resultado;

	$model_economico = new Economico();

	$resultado = $model_economico->insertar_pago($codigo,$nombres,$nro_recibo,$liquidacion,$resultado,$monto,$ciclo);

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/subir_pago_manual.view.php';
?>