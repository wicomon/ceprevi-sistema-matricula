<?php session_start();
	require_once 'models/Aulas.php';

	$ciclo=$_GET['country'];

	$conexion = new Aulas();
	$posts3 = $conexion->listar_aulasxciclo($ciclo);

	echo "<select>";
	foreach ($posts3 as $posts3) {
		echo '<option value="'.$posts3['aula'].'">'.$posts3['aula'].' </option>';
	}

	echo "</select>";
?>

