
<!DOCTYPE html>
<html>
<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php
	if($posts['estado']=='A'){$estado='ASISTENCIA';}if($posts['estado']=='F'){$estado='FALTA';}if($posts['estado']=='T'){$estado='TARDANZA';}if($posts['estado']=='J'){$estado='JUSTIFICADO';}
?>
<div class="container">
		<br><h2>Editar Asistencia</h2>
		<form class="formulario" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<input type="hidden" name="aula" readonly class="form-control" value="<?php echo $posts['aula']; ?>">
			<input type="hidden" name="fecha" readonly class="form-control" value="<?php echo $posts['fecha']; ?>">
			<input type="hidden" name="dia" readonly class="form-control" value="<?php echo $posts['dia']; ?>">
			<input type="hidden" name="mes" readonly class="form-control" value="<?php echo $posts['mes']; ?>">
			<input type="hidden" name="year" readonly class="form-control" value="<?php echo $posts['year']; ?>">
			<br><label for="codigo">Codigo :     </label>	
			<input type="text" name="codigo"  readonly class="form-control" value="<?php echo $posts['codigo']; ?>">
			<br><label for="nombre">Alumno :     </label>
			<input type="text" name="nombre" readonly class="form-control" value="<?php echo $posts['a_paterno'].' '.$posts['a_materno'].''.$posts['nombres']; ?>">
			<br><label for="nombre">Fecha :     </label>
			<input type="text" name="fechassss" readonly class="form-control" value="<?php echo substr($posts['fecha'], 8,2).' de '.$posts['mes'].' del '.$posts['year']; ?>">
			
			<br><label for="sede" class="badge badge-info">Condición :     </label>
				<select name="estado" class="form-control">
					<option value="<?php echo $posts['estado']; ?>" selected ><?php echo $estado; ?></option>
					<option value="A">ASISTENCIA</option>
					<option value="T">TARDANZA</option>
					<option value="F">FALTA</option>
					<option value="J">JUSTIFICADO</option>
				</select>
				
			<br><input type="submit" class="btn btn-danger" value="Modificar Asistencia">
		</form>
</div>
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

