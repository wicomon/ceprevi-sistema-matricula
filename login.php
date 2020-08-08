<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

$errores='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['codigo']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	try {
		$conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
	} catch (PDOExeption $e) {
		echo "Error: ". $e->getMessage();
	}

	$statement = $conexion->prepare('SELECT *FROM admin WHERE username=:codigo AND pass=:password');
	$statement->execute(array(':codigo'=>$usuario, ':password'=>$password));
	$resultado = $statement->fetch();

	

	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	}else{
		$errores .= '<li>Datos Incorrectos </li>';
	}

}

require 'views/login.view.php'; 
?>