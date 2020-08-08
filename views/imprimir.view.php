
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
						<br>

					<label for="sciclo">SEDE :     </label>
					<select name="aula" class="form-control" required="">
					  <option value="" disabled selected>Seleccionar la Sede</option>
					  <?php foreach ($posts2 as $posts2 ): ?>

					  <option value="<?php echo $posts2['sede']; ?>"><?php echo $posts2['sede']; ?></option>

					  <?php endforeach ?>
					</select>
					<br>
					 

					<label for="deuda">Tarjeta :     </label>
					<select name="deuda" class="form-control" required="">
					  <option value="" disabled selected>Seleccionar el Color de tarjeta</option>
					  <option value="color"> COLOR </option>
					  <option value="blanca"> BLANCA </option>
					</select>


				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

<?php endif ?>


	<?php if (isset($alumno)): ?>
	

	<div class="container">
		<br><br><label><h3>Tarjetas de Asistencia :   </h3>  </label> 
		<a href="tarjetasxsede.php?aul=<?php echo $_POST['aula']; ?>&color=<?php echo $a; ?>&cicl=<?php echo $_POST['sciclo']; ?>" target=_blank class="btn btn-success">Imprimir Tarjetas</a>
		<a href="reporte_sede.php?sede=<?php echo $_POST['aula']; ?>&cicl=<?php echo $_POST['sciclo']; ?>&color=<?php echo $_POST['deuda']; ?>" target=_blank class="btn btn-danger">Imprimir Listado</a><br>
		
	<br><table class="table table-bordered"> 
	<thead class="table-secondary">
		<tr>
			<td>N° </td><td>Codigo </td><td>Ap.Paterno</td><td>Ap.Materno</td><td>Nombre</td><td>ciclo</td><td>Aula</td><td>sede</td><td>Color</td><td>Acciones</td>
		</tr>
	</thead>
	<tbody>
		<?php $c=1; $monto_tot=0;?>
		<?php foreach ($alumno as $post ): ?>
			<?php foreach ($economico as $post1 ): ?>
				<?php if ($post1['codigo'] == $post['codigo'] ): ?>
					<?php  
						$monto_tot = $monto_tot + $post1['monto'];
						if($post['descuento']==0){
							$estado = 'completo';
						}
					?>
				<?php endif ?>
				<?php
				if($post['descuento']==!0){
					$descuento = 1800*$post['descuento']/100;
					$total_a_pagar= 1830 - $descuento;
				}else{
					$total_a_pagar = 1830;
				}
				?>

			<?php endforeach ?>	
			<?php if ($total_a_pagar <= $monto_tot && $a=='BLANCA' ): ?>
				<tr>
					<td><?php echo $c; $c++; ?><td><?php echo $post['codigo']?> </td><td><?php echo utf8_encode($post['a_paterno'])?></td>
					<td><?php echo utf8_encode($post['a_materno'])?></td><td><?php echo utf8_encode($post['nombres'])?></td><td><?php echo $post['ciclo']?></td>
					<td><?php echo $post['aula']?></td><td><?php echo $post['sede']?></td><td><?php echo $monto_tot;?></td>
					<td><a href="pdf2.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-secondary btn-sm" title="">	Tarjeta </a></td>
				</tr>
			<?php endif ?>
			<?php if ($total_a_pagar > $monto_tot && $a=='COLOR' ): ?>
				<tr>
					<td><?php echo $c; $c++; ?><td><?php echo $post['codigo']?> </td><td><?php echo utf8_encode($post['a_paterno'])?></td>
					<td><?php echo utf8_encode($post['a_materno'])?></td><td><?php echo utf8_encode($post['nombres'])?></td><td><?php echo $post['ciclo']?></td>
					<td><?php echo $post['aula']?></td><td><?php echo $post['sede']?></td><td><?php echo $monto_tot;?></td>
					<td><a href="pdf2.php?cod=<?php echo $post['codigo']; ?>" target=_blank class="btn btn-secondary btn-sm" title="">	Tarjeta  </a></td>
				</tr>
			<?php endif ?>
			<?php $monto_tot=0;?>
		<?php endforeach ?>
	</tbody>
</table> 

	</div>

<?php endif ?>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>