
<!DOCTYPE html>
<html>

<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="css/estilos2.css">
</head>

	<div class="contenedor">
		<header>
			<h1>Lista de Aulas</h1>
			<div>
				<button id="btn_cargar_usuarios" class="btn active">Cargar </button>
			</div>
		</header>
		<main>
			<form action="" method="" id="formulario" class="formulario">	
				<input type="text" name="nombre" id="nombre" placeholder="Nombre">
				<input type="text" name="edad" id="edad" placeholder="Edad">
				<input type="text" name="pais" id="pais" placeholder="Pais">
				<input type="email" name="correo" id="correo" placeholder="Correo">
				<button type="submit" class="btn">Agregar</button>
			</form>
			<div class="error_box" id="error_box">
				<p>Se ha producido un error.</p>
			</div>
			<table id="tabla" class="tabla">
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Edad</th>
					<th>Pais</th>
					<th>Carrera</th>
				</tr>
			</table>

			
			<div class="loader" id="loader"></div>
		</main>
	</div>


<script src="js/main.js"></script>
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>