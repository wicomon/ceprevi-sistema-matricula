<?php session_start();

require 'funciones.php';


$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}



require 'header.php';
require 'views/menu_alumno.view.php';


?>