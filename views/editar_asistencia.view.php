
<!DOCTYPE html>
<html>

<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php if (!isset($post)): ?>
		<div class="container">
			<br><h2>Alumnos</h2><br>
			<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<div class="form-group">
					<label for="exampleInputEmail1">Ingresar Codigo:</label>
					<input type="text" name="codigo">	
				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

<?php endif ?>


	<?php if (isset($posts)): ?>
	

	<div class="container">
		<br><br><h2>Asistencias </h2> 
		
	<br><table class="table table-bordered"> 
	<thead class="table-secondary">
		<tr>
			<td>Codigo </td><td>Alumno</td><td>Aula</td><td>Fecha</td><td>Estado</td><td>Acciones</td><td>Acciones</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post ): ?>
		<tr>

			<td><?php echo $post['codigo']?> </td><td><?php echo utf8_encode($post['a_paterno'].' '.$post['a_materno'].' '.$post['nombres'])?></td><td><?php echo $post['aula']?></td><td><?php echo substr($post['fecha'], 8,2).' de '.$post['mes'];?></td><td><?php echo $post['estado']?> </td>
			<td><a href="editar_asistencia2.php?cod=<?php echo $post['codigo']; ?>&fecha=<?php echo $post['fecha']; ?>" class="btn btn-danger btn-sm" title="">Modificar</a></td><td><a href="reporte_asistencia.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-success btn-sm" title="">Reporte Asistencia</a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table> 

	</div>

<?php endif ?>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>