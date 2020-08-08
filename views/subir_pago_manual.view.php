
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<div class="container">
		<br><h2>EDITAR PAGO</h2>
		<form class="formulario" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

		<div class="row">	
			<div class="col">
				<br><label for="liquidacion" class="badge badge-info">Liquidación :     </label>
				<input type="text" name="liquidacion" class="form-control" required>
			</div>
			
			<div class="col">
				<br><label for="nro_recibo" class="badge badge-info">Tipo de recibo :     </label>
				<input type="text" name="nro_recibo"   class="form-control" required>
			</div>
			
			<div class="col">
				<br><label for="monto" class="badge badge-danger">Monto :     </label>
				<input type="text" name="monto"  class="form-control" required>
			</div>

			<div class="col">
				<br><label for="fecha" class="badge badge-info">Fecha :     </label>
				<input type="date" name="fecha"   class="form-control" required>
			</div>
			
		</div>	
		

		<div class="row">		
			<div class="col">	
				<br><label for="codigo" class="badge badge-info">Código de Alumno:     </label>
				<input type="text" name="codigo"  class="form-control" required>
			</div>

			<div class="col">
				<br><label for="ciclo" class="badge badge-info">Ciclo:     </label>
				<input type="text" name="ciclo"  class="form-control" required>
			</div>

			<div class="col">
				<br><label for="nombres" class="badge badge-info">Nombres :     </label>
				<input type="text" name="nombres"   class="form-control" required>
			</div>
			
			
		</div>

			<br><input type="submit" class="btn btn-danger" value="Modificar Recibo">
		</form>
</div>




<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

