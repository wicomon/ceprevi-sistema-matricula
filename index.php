<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: menu.php');
} else{
	header('Location: login.php');
}

?>