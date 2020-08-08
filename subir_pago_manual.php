<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);



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

	$year = substr($fecha, 0 , 4);
	$month = substr($fecha, 5 , 2);
	$day = substr($fecha, 8 , 2);

	$resultado = $day.'/'.$month.'/'.$year;

	echo $resultado;

	$statement1 = $conexion->prepare('INSERT INTO economico (codigo, nombres,nro_recibo, liquidacion,fecha, monto,ciclo) VALUES (:codigo, :nombres, :nro_recibo, :liquidacion, :fecha, :monto, :ciclo)');
	$statement1->execute(array(':codigo'=>$codigo,':nombres'=>$nombres,':nro_recibo'=>$nro_recibo,':liquidacion'=>$liquidacion,':fecha'=>$resultado, ':monto'=>$monto, ':ciclo'=>$ciclo));

	header("Location: alumnos1.php?cod=$codigo");
	
}

require 'header.php';
require 'views/subir_pago_manual.view.php';
?>