<?php session_start();

require 'admin/config.php';
require 'funciones.php';



$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
	header('Location: '.RUTA);
}



require 'header.php';
require 'views/menu.view.php';


?>