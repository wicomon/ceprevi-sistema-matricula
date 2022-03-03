<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php if (!isset($post)) : ?>
	<div class="container">
		<br>
		<h2>Historial de Alumnos Matriculados</h2><br>
		<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Ingresar Apellido Paterno:</label>
				<input type="text" name="paterno">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Ingresar Apellido Materno:</label>
				<input type="text" name="materno">
			</div>
			<input type="submit" class="btn btn-primary" value="Consultar">
		</form>
	</div>

<?php endif ?>

<?php if (isset($posts)) : ?>
	<div class="container">
		<br><br><label>
			<h3>Historial : </h3>
		</label> <!-- <a href="historial.php?a1=<?php echo $dato['a_paterno']; ?>&a2=<?php echo $dato['a_materno']; ?>" class="btn btn-success">Generar Reporte</a>--><br>
		<br>
		<table class="table table-bordered">

			<thead class="table-secondary">
				<tr>
					<td>Codigo </td>
					<td>Ap.Paterno</td>
					<td>Ap.Materno</td>
					<td>Nombre</td>
					<td>ciclo</td>
					<td>Aula</td>
					<td>sede</td>
					<td>Acciones</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($posts as $post) : ?>
					<tr>
						<td><a href="alumnos1.php?cod=<?php echo $post['codigo']; ?>" class="btn btn-light" target=_blank><?php echo $post['codigo'] ?></a></td>
						<td><?php echo utf8_encode($post['a_paterno']) ?></td>
						<td><?php echo utf8_encode($post['a_materno']) ?></td>
						<td><?php echo utf8_encode($post['nombres']) ?></td>
						<td><?php echo $post['ciclo'] ?></td>
						<td><?php echo $post['aula'] ?></td>
						<td><?php echo $post['sede'] ?></td>
						<td><a href="historial.php?a1=<?php echo utf8_encode($post['a_paterno']); ?>&a2=<?php echo utf8_encode($post['a_materno']); ?>&a3=<?php echo $post['dni']; ?>" target=_blank class="btn btn-danger btn-sm" title="">Reporte</a></td>
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