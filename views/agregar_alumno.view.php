<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>


<div class="container">
	<br>
	<h2>AGREGAR ALUMNO</h2>
	<form class="formulario" id="formulario-crear-alumno" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="row">
			<div class="col">
				<br><label for="codigo">Codigo : </label>
				<input type="text" name="codigo" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="codigo">DNI : </label>
				<input type="text" name="dni" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="sexo">Sexo : </label>
				<select name="sexo" class="form-control" required>
					<option value="M" selected>Masculino</option>
					<option value="F">Femenino</option>
				</select>
			</div>
			<div class="col">
				<br><label for="nombre">Turno : </label>
				<select name="turno" class="form-control" required>
					<option value="M" selected>Mañana</option>
					<option value="T">Tarde</option>
				</select>
			</div>
		</div>
		<br><label for="sciclo">Carrera : </label>
		<select name="carrera" class="form-control" required>
			<option value="" disabled selected>Seleccionar la Carrera</option>
			<?php foreach ($especialidades as $especialidad) : ?>
				<option value="<?php echo $especialidad['cod_esp']; ?>"><?php echo utf8_encode($especialidad['especialidad']); ?></option>
			<?php endforeach ?>
		</select>
		<div class="row">
			<div class="col">
				<br><label for="nombre">Apellido Paterno : </label>
				<input type="text" name="paterno" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="nombre">Apellido Materno : </label>
				<input type="text" name="materno" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="nombre">Nombres : </label>
				<input type="text" name="nombres" class="form-control" required>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<br><label for="nombre">Aula : </label>
				<input type="text" name="aula" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="nombre">Ciclo : </label>
				<input type="text" name="ciclo" class="form-control" required>
			</div>
			<div class="col">
				<br><label for="sede">SEDE : </label>
				<select name="sede" class="form-control" required>
					<option value="" disabled selected>Seleccionar la Sede</option>
					<?php foreach ($sedes as $sede) : ?>
						<option value="<?php echo $sede['sede']; ?>"><?php echo $sede['sede']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<br><input type="submit" class="btn btn-danger" value="Agregar Alumno"><br><br>

			<?php if($error_insert):?>
				<div class="alert alert-danger" role="alert">
					No se inserto ningun alumno
				</div>
			<?php endif;?>

	</form>
</div>
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- <script>
	const formulario = document.querySelector('#formulario-crear-alumno');
	formulario.addEventListener('submit', e => {
		e.preventDefault();
		const codigo = document.querySelector("#codigo").value;
		const dni = document.querySelector("#dni").value;
		const sexo = document.querySelector("#sexo").value;
		const turno = document.querySelector("#turno").value;
		const carrera = document.querySelector("#carrera").value;
		const nombres = document.querySelector("#nombres").value;
		const paterno = document.querySelector("#paterno").value;
		const materno = document.querySelector("#materno").value;
		const aula = document.querySelector("#aula").value;
		const ciclo = document.querySelector("#ciclo").value;
		const sede = document.querySelector("#sede").value;

		const data = {
			codigo,
			dni,
			sexo,
			turno,
			carrera,
			paterno,
			materno,
			aula,
			ciclo,
			sede,
		}
		if (codigo == '',
			dni == '',
			sexo == '',
			turno == '',
			carrera == '',
			paterno == '',
			materno == '',
			aula == '',
			ciclo == '',
			sede == '') {
			return alert('Todos los campos son obligatorios');
		}
		if (confirm('Esta seguro que desea crear el alumno con codigo : ' + codigo)) {


			var datos = new FormData();
			datos.append( "json", JSON.stringify( data ) );

			fetch("agregar_alumno.php",
			{
					method: "POST",
					body: datos
			})
			.then(function(res){ return res.json(); })
			.then(function(datos){ console.log( JSON.stringify( datos )  )})

		}

		console.log(data)

		
	})
</script> -->
</body>

</html>