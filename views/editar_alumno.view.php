
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<div class="container">
		<br><h2>EDITAR ALUMNO</h2>
		<form class="formulario" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">



		<div class="row">	
			<div class="col">
				<br><label for="codigo" class="badge badge-info">Codigo :     </label>
				<input type="text" name="codigo" class="form-control" value="<?php echo $posts['codigo']; ?>" readonly>
			</div>
			<div class="col">
				<br><label for="codigo" class="badge badge-info">DNI :     </label>
				<input type="text" name="dni"   class="form-control" value="<?php echo $posts['dni']; ?>">
			</div>
			<div class="col">
				<br><label for="sexo" class="badge badge-info" class="badge badge-info">Sexo :     </label>
			<select name="sexo" class="form-control">
				<?php if ($posts['sexo']=='M'): ?>
				<option value="M" selected>Masculino</option>
				<option value="F">Femenino</option>
				<?php endif ?>
				<?php if ($posts['sexo']=='F'): ?>
				<option value="M">Masculino</option>
				<option value="F" selected>Femenino</option>
				<?php endif ?>
			</select>
			</div>
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Turno :     </label>
				<select name="turno" class="form-control">
					<?php if ($posts['turno']=='M'): ?>
						<option value="M" selected>Mañana</option>
						<option value="T">Tarde</option>
					<?php endif ?>
					<?php if ($posts['turno']=='T'): ?>
						<option value="M">Mañana</option>
						<option value="T" selected="">Tarde</option>
					<?php endif ?>
				</select>
			</div>
		</div>	
		<br><label for="sciclo" class="badge badge-info">Carrera :     </label>
			<select name="carrera" class="form-control">
				<?php foreach ($posts1 as $especialidades ): ?>
					<?php if ($especialidades['cod_esp']==$posts['carrera']): ?>
						<option value="<?php echo $especialidades['cod_esp']; ?>" selected ><?php echo utf8_encode($especialidades['especialidad']); ?></option>
					<?php endif ?>
					<?php if ($especialidades['cod_esp']!==$posts['carrera']): ?>
						<option value="<?php echo $especialidades['cod_esp']; ?>"><?php echo utf8_encode($especialidades['especialidad']); ?></option>  
					<?php endif ?>
				<?php endforeach ?>
			</select>
				
		<div class="row">	
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Apellido Paterno :     </label>
				<input type="text" name="paterno"  class="form-control" value="<?php echo utf8_encode($posts['a_paterno']); ?>">
			</div>
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Apellido Materno :     </label>
			<input type="text" name="materno"  class="form-control" value="<?php echo utf8_encode($posts['a_materno']); ?>">
			</div>
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Nombres :     </label>
				<input type="text" name="nombres"  class="form-control" value="<?php echo utf8_encode($posts['nombres']); ?>">
			</div>
		</div>

		<div class="row">
			<div class="col">
				<br><label for="descuento" class="badge badge-info">DESCUENTO :     </label>
				<input type="text" name="descuento"  class="form-control is-invalid" value="<?php echo $posts['descuento']; ?>">
			</div>
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Aula :     </label>
				<input type="text" name="aula"  class="form-control" value="<?php echo $posts['aula']; ?>">
			</div>
			<div class="col">
				<br><label for="nombre" class="badge badge-info">Ciclo :     </label>
				<input type="text" name="ciclo"  class="form-control" value="<?php echo $posts['ciclo']; ?>">
			</div>
			<div class="col">
				<br><label for="sede" class="badge badge-info">SEDE :     </label>
				<select name="sede" class="form-control">
					<option value="" disabled selected>Seleccionar la Sede</option>
					  <?php foreach ($posts2 as $posts2 ): ?>
					  <?php if ($posts2['sede']==$posts['sede']): ?>
					  	<option value="<?php echo $posts2['sede']; ?>" selected ><?php echo $posts2['sede']; ?></option>
						<?php endif ?>
					  <option value="<?php echo $posts2['sede']; ?>"><?php echo $posts2['sede']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

			<br><input type="submit" class="btn btn-danger" value="Modificar Datos"><br><br> 
			<?php if($error_insert):?>
				<div class="alert alert-danger" role="alert">
					No se inserto ningun alumno
				</div>
			<?php endif;?>
		</form>
</div>




<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

