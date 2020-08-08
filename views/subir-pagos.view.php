<br>
<div class="container">

<h2>Subir Pagos &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<a href="subir_pago_manual.php" class="btn btn-danger btn-large" title="" >Subir Pago Manualmente</a></h2><br>

			<div class="container border">
				<h4>Ejemplo : </h4>
				<img src="images/modelo_pago.jpg" width="800px">
			</div>
			<br>
<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
	<div class="form-group">
        <input type="file"   required name="file">
	</div>
	<input type="submit" class="btn btn-primary" value="Importar">
</form>



</div>