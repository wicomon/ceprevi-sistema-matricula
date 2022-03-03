<?php session_start();

require_once 'models/Login.php';

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

$errores='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['codigo']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];

	$conexion = new Login();
	$resultado = $conexion->buscar_usuario($usuario, $password);
	$conexion->close();


	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	}else{
		$errores .= '<li>Datos Incorrectos </li>';
	}

}

require 'views/login.view.php'; 
?>