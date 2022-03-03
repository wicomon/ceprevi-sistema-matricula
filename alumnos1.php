<?php session_start();

require 'funciones.php';



$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['cod'])) {
	
	if(isset($_GET['cod'])){
		$codi = $_GET['cod'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$codi = $_POST['codigo'];
	}

	require_once 'models/Alumno.php';

	$conexion = new Alumno();
	$post=$conexion->buscar_alumno_completo($codi);

	$post2 = $conexion->buscar_alumno_pagos($codi);



	if($post){
		$valid = 1;
	}else{
		$valid=0;
	}
}


require 'header.php';

require 'views/alumnos1.view.php';

?>

