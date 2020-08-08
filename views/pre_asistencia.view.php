<!DOCTYPE html>
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<div class="container">
			<br><br>
	<form class="" method="get" action="asistencia.php">
		<div class="form-group">
			<h3><label for="sciclo" class="badge badge-info">CICLO :     </label></h3>
			
            <select name="sciclo" id="sciclo" class="form-control" required onChange="change_country();" placeholder="Seleccionar CicLO">
				<option value="selected" selected disabled>Seleccionar el ciclo</option>
				<?php foreach ($posts1 as $posts1 ): ?>
					<option value="<?php echo $posts1['ciclo']; ?>" ><?php echo $posts1['ciclo']; ?></option>
				<?php endforeach ?>
			</select>
			<br>
			<div class="row">
				<div class="col">
					<h3><label for="fecha" class="badge badge-info">SELECCIONAR LA FECHA :     </label></h3>
					<input type="date" name="fecha"  class="form-control" required>
				</div>

   				<div class="col">
					<h3><label for="sciclo" class="badge badge-info">AULA :     </label></h3>
					<select name="aula" id="aula" class="form-control" required="">
					</select>
					<br>
				</div>	
		</div>
		<input type="submit" class="btn btn-primary" id="boton" value="Ir a asistencia">
	</form>
</div>
<script type="text/javascript">
	function change_country(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","ajax2.php?ciclo="+document.getElementById("sciclo").value,false);
		xmlhttp.send(null);
		document.getElementById("aula").innerHTML=xmlhttp.responseText;

		var boton = document.getElementById("boton");
		boton.addEventListener('click',function() {
    		if(document.getElementById("sciclo").value=="selected"){
				alert("seleccionar ciclo");
			}
		});
	}
</script>				
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>


