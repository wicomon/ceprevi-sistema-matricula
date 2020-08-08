
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

					<label for="sede">SEDE :     </label>
					<select name="sede" class="form-control" required="">
					  <option value="" disabled selected>Seleccionar el sede</option>
					  <?php foreach ($posts3 as $posts3 ): ?>

					  <option value="<?php echo $posts3['sede']; ?>"><?php echo $posts3['sede']; ?></option>

					  <?php endforeach ?>
					</select>


				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

<?php endif ?>


	<?php if (isset($posts)): ?>
	

	<div class="container">
		<br><br><label><h3>Tarjetas de Asistencia :   </h3>  </label> <a href="reporte_general.php?sede=<?php echo $_POST['sede']; ?>&cicl=<?php echo $_POST['sciclo']; ?>" target=_blank class="btn btn-danger">Imprimir Listado</a><br>
		
	<br><table class="table table-bordered"> 
	<thead class="table-secondary">
		<tr>
			<td>N° </td><td>Codigo </td><td>Ap.Paterno</td><td>Ap.Materno</td><td>Nombre</td><td>ciclo</td><td>Aula</td><td>sede</td><td>Pagos</td>
		</tr>
	</thead>
	<tbody>
		<?php $c=1; ?>
		<?php foreach ($posts as $post ): ?>
		<tr>
			<td><?php echo $c; $c++; ?><td><?php echo $post['codigo']?> </td><td><?php echo utf8_encode($post['a_paterno'])?></td><td><?php echo utf8_encode($post['a_materno'])?></td><td><?php echo utf8_encode($post['nombres'])?></td><td><?php echo $post['ciclo']?></td><td><?php echo $post['aula']?></td><td><?php echo $post['sede']?></td>

			<?php

				$cod = $post['codigo'];
				if($post['descuento']==!0){
					$descuento = 1800*$post['descuento']/100;
					$total_a_pagar= 1830 - $descuento;
				}else{
					$total_a_pagar = 1830;
				}
				if($total_pago[$cod]<$total_a_pagar){
					echo '<td style="color: #000; background:#F9BABA ;">'.$total_pago[$cod].'</td>'; //R O J O
				}else{
					echo '<td style="color: #000; background:#C5F0F3 ;">'.$total_pago[$cod].'</td>';
				}
				

			/*if ($total_pago[$cod]== ) {
					echo "<td>BLANCO</td>";
				}
				if ($post2['monto']==!'0') {
					echo "<td>COLOR</td>";
				}*/
			?>
			
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