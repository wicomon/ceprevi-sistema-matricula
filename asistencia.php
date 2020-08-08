<?php session_start();

require 'admin/config.php';
require 'funciones.php';

$conexion = conexion($bd_config);

$resultado = traerDatos();
$admin = datosAdmin();

if (!isset($_SESSION['usuario'])) {
	header('Location: index.php');
}



$cicl= $_GET['sciclo'];
$aul=$_GET['aula'];
$fecha=$_GET['fecha'];
$aaa=strtotime($fecha);
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

$resultado = substr($_GET['fecha'], 5,2);
$resultado1 = substr($fecha, 5,2);
$elrealmes = substr($fecha, 5,2);

	$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE aula=:aula AND ciclo=:ciclo ORDER BY a_paterno,a_materno,nombres");
	$sentencia->execute(array(':aula'=>$_GET['aula'],':ciclo'=>$_GET['sciclo']));
	$posts = $sentencia->fetchAll();

	$comprobante = $conexion->prepare("SELECT * FROM asistencia WHERE aula=:aula AND fecha=:fecha");
	$comprobante->execute(array(':aula'=>$_GET['aula'],':fecha'=>$_GET['fecha']));
	$compro = $comprobante->fetch();
	

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$c=1;
	foreach ($posts as $vuelta ) {
	$p = 'p'.$c;
	$n='cod_'.$c;

	$codigo = $_POST[$n];
	$aula = $_GET['aula'];
	$fecha = $_GET['fecha'];
	$dia = $_POST['dia'];
	$dia_nro = substr($_GET['fecha'], 8,2);
	$mes = $meses[$resultado-1];
	$year = $_POST['year'];
	$p[$c] = $_POST[$p];

	if ($dia=='Monday') {$dia='Lunes';}if ($dia=='Tuesday') {$dia='Martes';}if ($dia=='Wednesday') {$dia='Miercoles';}if ($dia=='Thursday') {$dia='Jueves';}if ($dia=='Friday') {$dia='Viernes';}if ($dia=='Saturday') {$dia='Sabado';}if ($dia=='Sunday') {$dia='Domingo';}


	$statement = $conexion->prepare('INSERT INTO asistencia (codigo, aula,fecha, dia,dia_nro, mes,mes_nro,year,estado,user) VALUES (:codigo,:aula, :fecha, :dia,:dia_nro, :mes,:mes_nro, :year,:estado,:user)');
	$statement->execute(array(':codigo'=>$codigo,':aula'=>$aula,':fecha'=>$fecha,':dia'=>$dia,':dia_nro'=>$dia_nro, ':mes'=>$mes,':mes_nro'=>$elrealmes, ':year'=>$year,':estado'=>$p[$c],':user'=>$admin['username']));
	$c++;

	header('Location: pre_asistencia.php');
	}

	
}

require 'header.php';

require 'views/asistencia.view.php';

?>

