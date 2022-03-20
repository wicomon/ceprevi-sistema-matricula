<?php session_start();

require 'funciones.php';



if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}


require 'header.php';
require 'views/menu_tarjetas.view.php';


?>