
<!DOCTYPE html>
<html>

<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php if (!isset($post)): ?>
		<div class="container">
			<br><br>
			<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<div class="form-group">
					<label for="sciclo">CICLO :     </label>
					<select name="sciclo" class="form-control" required="">
					  <option value="" disabled selected>Seleccionar el ciclo</option>
					  <?php foreach ($posts1 as $posts1 ): ?>

					  <option value="<?php echo $posts1['ciclo']; ?>" selected><?php echo $posts1['ciclo']; ?></option>

					  <?php endforeach ?>
					</select>



				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

<?php endif ?>


	<?php if (isset($posts)): ?>
	

	<div class="container">
		<br><br><label><h3>Tarjetas de Asistencia :   </h3>  </label> <a href="reporte_total.php?ciclo=<?php echo $_POST['sciclo']; ?>" target=_blank class="btn btn-danger">Imprimir Listado</a><br>
		
	<br><table class="table table-bordered"> 
	<thead class="table-secondary">
		<tr>
			<td>N° </td><td>Codigo </td><td>Ap.Paterno</td><td>Ap.Materno</td><td>Nombre</td><td>ciclo</td><td>Aula</td><td>sede</td>
		</tr>
	</thead>
	<tbody>
		<?php $c=1; ?>
		<?php foreach ($posts as $post ): ?>
		<tr>
			<td><?php echo $c; $c++; ?><td><?php echo $post['codigo']?> </td><td><?php echo $post['a_paterno']?></td><td><?php echo $post['a_materno']?></td><td><?php echo $post['nombres']?></td><td><?php echo $post['ciclo']?></td><td><?php echo $post['aula']?></td><td><?php echo $post['sede']?></td>

			
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