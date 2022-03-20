<?php session_start();

// require 'admin/config.php';
require 'funciones.php';


// $conexion = conexion($bd_config);

$resultado = traerDatos();

if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

// $posts = obtener_post($conexion);

require 'header.php';
require 'views/menu_asistencia.view.php';


?>