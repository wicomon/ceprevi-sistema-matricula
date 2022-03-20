<?php 

// function conexion($bd_config){
// 	try {
// 	$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'],$bd_config['usuario'],$bd_config['pass']);
// 	return $conexion;
// 	} catch (PDOException $e) {
		
// 	}
// }

function limpiarDatos($datos){
	$datos = trim($datos);
	$datos = stripslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}

function traerDatos(){
	// $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','');
	// $statement = $conexion->prepare("SELECT *FROM alumno WHERE codigo=:codigo");
	// $statement->execute(array(':codigo'=>$_SESSION['usuario']));
	// $resultado = $statement->fetch();
	// return $resultado;
}
function verificarPrivilegios($privilegio){
	if ($privilegio > 2) {
		header('Location: index.php');
	}
}
// function datosAdmin(){
// 	$conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','');
// 	$statement = $conexion->prepare("SELECT *FROM admin WHERE username=:username");
// 	$statement->execute(array(':username'=>$_SESSION['usuario']));
// 	$admin = $statement->fetch();
// 	return $admin;
// }


// function id_articulo($id){
// 	return (int)limpiarDatos($id);
// }


// function traerPreguntas(){
// 	$conexion = new PDO('mysql:host=localhost;dbname=ceprevi,root,');
// 	$statement = $conexion->prepare("SELECT *FROM preguntas ");
// 	$statement->execute();
// 	$resultado = $statement->fetchAll();
// 	return $resultado;
// }

// function obtener_post_por_id($conexion, $id){
// 	$resultado = $conexion->query("SELECT *FROM preguntas WHERE id=$id LIMIT 1");
// 	$resultado = $resultado->fetchAll();
// 	return ($resultado) ? $resultado : false;
// }

// function pagina_actual(){
// 	return isset($_GET['p']) ? (int)$_GET['p'] : 1;
// }

// function obtener_post($conexion){
// 	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM encuesta");
// 	$sentencia->execute();
// 	return $sentencia->fetchAll();
// }

// function obtener_preguntas($conexion){
// 	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM preguntas");
// 	$sentencia->execute();
// 	return $sentencia->fetchAll();
// }

// function obtener_post_profesor($conexion,$cod_prof){
// 	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM encuesta WHERE cod_prof=$cod_prof");
// 	$sentencia->execute();
// 	return $sentencia->fetchAll();
// }
// function obtener_post_alumno($conexion,$cod_alumno){
// 	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM encuesta WHERE codigo=$cod_alumno");
// 	$sentencia->execute();
// 	return $sentencia->fetchAll();
// }
// function obtener_post_curso($conexion,$cod_curso){
// 	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM encuesta WHERE curso=$cod_curso");
// 	$sentencia->execute();
// 	return $sentencia->fetchAll();
// }

// function prueba($aula,$cursito){
// 	$conexion = new PDO('mysql:host=localhost;dbname=encuesta','root','');
// 	$statement = $conexion->prepare('SELECT *FROM aula INNER JOIN docente ON aula.cod_prof=docente.codigo WHERE aula.codigo=:aula AND docente.curso=:curso');
// 	$statement->execute(array(':aula'=>$aula,':curso'=>$cursito));
// 	$resultado = $statement->fetchAll();
// 	return $resultado;
// }

?>