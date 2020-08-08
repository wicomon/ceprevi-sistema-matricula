<?php session_start();

	$country=$_GET['country'];

	$conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
	$sentencia3 = $conexion->prepare("SELECT DISTINCT aula FROM alumno WHERE ciclo=:ciclo");
	$sentencia3->execute(array(':ciclo'=>$country));
	$posts3 = $sentencia3->fetchAll();

	echo "<select>";
	foreach ($posts3 as $posts3) {
		echo '<option value="'.$posts3['aula'].'">'.$posts3['aula'].' </option>';
	}

	echo "</select>";
?>

