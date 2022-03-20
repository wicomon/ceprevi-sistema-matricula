<?php session_start();

	require_once 'models/Aulas.php';

	$model_aula = new Aulas();

	$ciclo=$_GET['ciclo'];

	$posts3 = $model_aula->listar_aulasxciclo($ciclo);

	echo "<select>";
	foreach ($posts3 as $posts3) {
		echo '<option value="'.$posts3['aula'].'">'.$posts3['aula'].' </option>';
	}

	echo "</select>";
?>

