<?php 


$codigo=$_GET['cod'];

$conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
$sentencia = $conexion->prepare("DELETE FROM aulas WHERE ID=:id ");
$sentencia->execute(array(':id'=>$codigo));

header("Location: ../");


?>