
<!DOCTYPE html>
<html>

<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php if (!isset($post)): ?>
	<div class="container">
		<br><br>
		<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group row">
				<div class="col">
					<label for="sciclo">CICLO :     </label>
					<select name="sciclo" id="countrydd" class="form-control" onChange="change_country();">
					  <option value="" disabled selected>Seleccionar el ciclo</option>
					  <?php foreach ($posts1 as $posts1 ): ?>
					  <option value="<?php echo $posts1['ciclo']; ?>"><?php echo $posts1['ciclo']; ?></option>
					  <?php endforeach ?>
					</select>
				</div>

				<div class="col">
					 <label for="aula">Aula :     </label>
					<select name="aula" id="state" class="form-control">
					  <option>Seleccionar Aula</option>
					</select>
				</div>
			</div>
			<input type="submit" class="btn btn-primary" value="Consultar">
		</form>
		
	</div>


<?php endif ?>
	<?php if (isset($posts)): ?>
	

	<div class="container">
		<br><br><label><h3>Tarjetas de Asistencia :   </h3>  </label> <a href="pdf3.php?aul=<?php echo $_POST['aula']; ?>&cicl=<?php echo $_POST['sciclo']; ?>" target=_blank class="btn btn-success">Imprimir Tarjetas</a><br>
		
	<br><table class="table table-bordered"> 
	<thead class="table-secondary">
		<tr>
			<td>N° </td><td>Codigo </td><td>Ap.Paterno</td><td>Ap.Materno</td><td>Nombre</td><td>ciclo</td><td>Aula</td><td>sede</td><td>Acciones</td>
		</tr>
	</thead>
	<tbody>
		<?php $c=1; ?>
		<?php foreach ($posts as $post ): ?>
		<tr>
			<td><?php echo $c; $c++; ?><td><?php echo $post['codigo']?> </td><td><?php echo utf8_encode($post['a_paterno'])?></td><td><?php echo utf8_encode($post['a_materno'])?></td><td><?php echo utf8_encode($post['nombres'])?></td><td><?php echo $post['ciclo']?></td><td><?php echo $post['aula']?></td><td><?php echo $post['sede']?></td>
			<td><a href="pdf2.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-secondary btn-sm" title="">	Tarjeta de Asistencia </a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table> 

	</div>

<?php endif ?>

<script type="text/javascript">
	function change_country(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","ajax.php?country="+document.getElementById("countrydd").value,false);
		xmlhttp.send(null);
		document.getElementById("state").innerHTML=xmlhttp.responseText;
	}
</script>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>