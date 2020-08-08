
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
					<input type="text" name="codigo" required>	
				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

<?php endif ?>



<?php if (isset($post)): ?>

<?php if ($valid == 1): ?>
	<div class="container">
		<br><h2>Alumnos</h2><br>
		<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Ingresar Codigo:</label>
						<input type="text" name="codigo" required>	
			</div>
			<input type="submit" class="btn btn-primary" value="Consultar">
		</form>
	</div>

	<div class="container">
			<br><br><h2>Datos del Alumno : 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<a href="ficha_alumno.php?cod=<?php echo $post['codigo']; ?>" class="btn btn-danger btn-large" title="" target="_blank">Ficha de Alumno</a></h2>
			<div class="col">
				<div class="row">
					<div class="col">	
						<div class="col">
							<br><label for="nombre" class="badge badge-info">Apellido Paterno :     </label>
							<input type="text" name="paterno"  class="form-control" placeholder="<?php echo utf8_encode($post['a_paterno']); ?>" readonly>
						</div>
						<div class="col">
							<br><label for="nombre" class="badge badge-info">Apellido Materno :     </label>
							<input type="text" name="materno"  class="form-control" placeholder="<?php echo utf8_encode($post['a_materno']); ?>" readonly>
						</div>
						<div class="col">
							<br><label for="nombre" class="badge badge-info">Nombres :     </label>
							<input type="text" name="nombres"  class="form-control" placeholder="<?php echo utf8_encode($post['nombres']); ?>" readonly>
						</div>
					</div>
			<div class="col">
				<img src="images/<?php echo $post['ciclo'];?>/fotos/<?php echo $post['codigo'];?>.jpg" width="400px">
			</div>
		</div>
				
				<div class="row">
					<div class="col">
						<br><label for="carrera" class="badge badge-info">Carrera Profesional :     </label>
						<input type="text" name="carrera"  class="form-control" placeholder="<?php echo utf8_encode($post['especialidad']); ?>" readonly>
					</div>
					<div class="col">
						<br><label for="descuento" class="badge badge-info">Descuento :     </label>
						<input type="text" name="descuento"   class="form-control is-invalid" placeholder="<?php echo $post['descuento']; ?>%" readonly>
					</div>
				</div>
				<div class="row">	
					<div class="col">
						<br><label for="codigo" class="badge badge-info">Codigo :     </label>
						<input type="text" name="codigo"   class="form-control" placeholder="<?php echo $post['codigo']; ?>" readonly>
					</div>
					<div class="col">
						<br><label for="codigo" class="badge badge-info">DNI :     </label>
						<input type="text" name="dni"   class="form-control" placeholder="<?php echo $post['dni']; ?>" readonly>
					</div>
					<div class="col">
						<br><label for="sexo" class="badge badge-info">Sexo :     </label>
						<?php if ($post['sexo'] == 'M'): ?>
							<input type="text" name="sexo"  class="form-control" placeholder="Masculino" readonly>
						<?php endif ?>
						<?php if ($post['sexo'] == 'F'): ?>
							<input type="text" name="sexo"  class="form-control" placeholder="Femenino" readonly>
						<?php endif ?>
						
					</div>
					<div class="col">
						<br><label for="turno" class="badge badge-info">Turno :     </label>
						<?php if ($post['turno'] == 'M'): ?>
							<input type="text" name="turno"  class="form-control" placeholder="Mañana" readonly>
						<?php endif ?>
						<?php if ($post['turno'] == 'T'): ?>
							<input type="text" name="turno"  class="form-control" placeholder="Tarde" readonly>
						<?php endif ?>
					</div>	
				</div>
				<div class="row">	
					<div class="col">
						<br><label for="nombre" class="badge badge-info">Aula :     </label>
						<input type="text" name="aula"  class="form-control" placeholder="<?php echo $post['aula']; ?>" readonly>
					</div>
					<div class="col">
						<br><label for="nombre" class="badge badge-info">Ciclo :     </label>
						<input type="text" name="ciclo"  class="form-control" placeholder="<?php echo $post['ciclo']; ?>" readonly>
					</div>
					<div class="col">
						<br><label for="sede" class="badge badge-info">Sede :     </label>
						<input type="text" name="sede"  class="form-control" placeholder="<?php echo $post['sede']; ?>" readonly>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="container">
						<h3>Recibos :</h3>
						<table class="table table-sm">
							<thead class="badge-info">
								<tr>
								<th scope="col">Código</th>
								<th scope="col">Nombres</th>
								<th scope="col">Fecha</th>
								<th scope="col">Liquidación</th>
								<th scope="col">Tipo de Pago</th>
								<th scope="col">Monto</th>
								
								</tr>
							</thead>
							<tbody>
								<?php
									$total_monto = 0;
									foreach ($post2 as $post) {
										echo '<tr><th scope="row">'.$post['codigo'].'</th><td>'.utf8_encode($post['nombres']).'</td><td>'.utf8_encode($post['fecha']).'</td>
										<td>'.$post['liquidacion'].'</td><td> '.$post['nro_recibo'].'</td><td> S/.'.$post['monto'].'</td>
										<td><a href="editar_pago.php?cod='.$post['liquidacion'].'" class="badge badge-info">Editar</a></td></tr>';
										if ($post['nro_recibo']=='P100') {
											$total_monto= $total_monto + $post['monto'];
										}
									}
								?>
								<thead class="thead-light">
									<tr>
										<th scope="col"><center>Total</center></th>
										<th scope="col">Pagado</th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col">S/.<?php echo $total_monto; ?></th>
									</tr>
								</thead>
							</tbody>
						</table>
					</div>
				</div>

			</div>	
		</div><br>

		<div class="container">
			<h2>	Acciones</h2>
			<table class="table"> 		
				<tr>
					<td><a href="fotocheck.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-success btn-large" title="">Imprimir Fotocheck</a></td>
					<td><a href="pdf.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-warning btn-large" title="">Constancia de estudios</a></td>
					<td><a href="pdf2.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-info btn-large" title="">Tarjeta de Asitencia</a></td>
					<td><a href="editar_alumno.php?cod=<?php echo $post['codigo']; ?>" class="btn btn-danger btn-large" title="" >Editar Datos</a></td>
				</tr>
				</table> 
		</div>

		
	</div>
<?php endif ?>

<?php if ($valid != 1): ?>

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

	<br><br><div class="container">
		<h2>No existe alumno con ese código</h2>
	</div>

<?php endif ?>
	
<?php endif ?>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>