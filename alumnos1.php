<?php session_start();

require 'admin/config.php';
require 'funciones.php';


$conexion = conexion($bd_config);

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
	$sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN especialidades ON alumno.carrera=especialidades.cod_esp WHERE alumno.codigo=:paterno  ORDER BY a_materno,nombres");
	$sentencia->execute(array(':paterno'=>$codi));
	$post = $sentencia->fetchAll();


	$sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE codigo=:paterno  ORDER BY fecha DESC");
	$sentencia2->execute(array(':paterno'=>$codi));
	$post2 = $sentencia2->fetchAll();



	if(isset($post[0])){
		$post = $post[0];
		$valid = 1;
	}else{
		$valid=0;
	}
}


require 'header.php';

require 'views/alumnos1.view.php';

?>

