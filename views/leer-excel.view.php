<br>
<div class="container">
<H3>IMPORTAR ALUMNOS : </H3>
<div class="container border">
				<h4>Ejemplo : </h4>
				<img src="images/modelo_alumno.jpg" width="800px">
			</div>
			<br>
<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
	<div class="form-group">
        <input type="file"   required name="file">
	</div>
	<input type="submit" class="btn btn-primary" value="Importar">
</form>



</div>