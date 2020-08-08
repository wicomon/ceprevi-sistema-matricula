<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);



	$statement = $conexion->prepare("SELECT * FROM economico WHERE liquidacion=:liquidacion");
	$statement->execute(array(':liquidacion'=>$_GET['cod']));
	$posts = $statement->fetch();

	/*$sentencia = $conexion->prepare("SELECT * FROM asistencia INNER JOIN alumno ON asistencia.codigo=alumno.codigo WHERE asistencia.codigo=:codigo AND asistencia.fecha=:fecha ");
	$sentencia->execute(array(':codigo'=>$_GET['cod'],':fecha'=>$_GET['fecha']));
	$posts = $sentencia->fetch();*/


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Limpiamos los datos para evitar que el usuario inyecte codigo.
	$codigo = $_POST['codigo'];
	$nombres = $_POST['nombres'];
	$nro_recibo = $_POST['nro_recibo'];
	$liquidacion = $_POST['liquidacion'];
	$fecha = $_POST['fecha'];
	$monto = $_POST['monto'];
	$ciclo = $_POST['ciclo'];


	$statement1 = $conexion->prepare('UPDATE economico SET  codigo=:codigo, nombres=:nombres, nro_recibo=:nro_recibo,liquidacion=:liquidacion, fecha=:fecha,monto=:monto,ciclo=:ciclo WHERE liquidacion =:liquidacion');
	$statement1->execute(array(':codigo'=>$codigo,':nombres'=>$nombres,':nro_recibo'=>$nro_recibo,':liquidacion'=>$liquidacion,':fecha'=>$fecha, ':monto'=>$monto, ':ciclo'=>$ciclo));

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/editar_pago.view.php';
?>