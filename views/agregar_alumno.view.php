
<!DOCTYPE html>
<html>
<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>


<div class="container">
		<br><h2>AGREGAR ALUMNO</h2>
		<form class="formulario" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="row">	
			<div class="col">
				<br><label for="codigo">Codigo :     </label>
				<input type="text" name="codigo"   class="form-control">
			</div>
			<div class="col">
				<br><label for="codigo">DNI :     </label>
				<input type="text" name="dni"   class="form-control">
			</div>
			<div class="col">
				<br><label for="sexo">Sexo :     </label>
			<select name="sexo" class="form-control">
				<option value="M" selected>Masculino</option>
				<option value="F">Femenino</option>
			</select>
			</div>
			<div class="col">
				<br><label for="nombre">Turno :     </label>
			<select name="turno" class="form-control">
				<option value="M" selected>Mañana</option>
				<option value="T">Tarde</option>
			</select>
			</div>
		</div>	
			<br><label for="sciclo">Carrera :     </label>
				<select name="carrera" class="form-control">
					<option value="" disabled selected>Seleccionar la Carrera</option>
					  <?php foreach ($posts1 as $posts1 ): ?>
					  <option value="<?php echo $posts1['cod_esp']; ?>"><?php echo utf8_encode($posts1['especialidad']); ?></option>
					<?php endforeach ?>
				</select>
		<div class="row">	
			<div class="col">
				<br><label for="nombre">Apellido Paterno :     </label>
				<input type="text" name="paterno"  class="form-control">
			</div>
			<div class="col">
				<br><label for="nombre">Apellido Materno :     </label>
			<input type="text" name="materno"  class="form-control">
			</div>
			<div class="col">
				<br><label for="nombre">Nombres :     </label>
				<input type="text" name="nombres"  class="form-control">
			</div>
		</div>
		<div class="row">	
			<div class="col">
				<br><label for="nombre">Aula :     </label>
				<input type="text" name="aula"  class="form-control">
			</div>
			<div class="col">
				<br><label for="nombre">Ciclo :     </label>
				<input type="text" name="ciclo"  class="form-control">
			</div>
			<div class="col">
				<br><label for="sede">SEDE :     </label>
				<select name="sede" class="form-control">
					<option value="" disabled selected>Seleccionar la Sede</option>
					  <?php foreach ($posts2 as $posts2 ): ?>
					  <option value="<?php echo $posts2['sede']; ?>"><?php echo $posts2['sede']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
			<br><input type="submit" class="btn btn-danger" value="Agregar Alumno">
		</form>
</div>
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

