<!DOCTYPE html>
<html>
<head>
	
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/estilos1.css">
</head>

 
<body>
<!--  <header>
    <div class="contenedor">
      <h1 class="titulo"> Panel de Control</h1>
    </div>
  </header>-->

  <br><section class="fotos">
    <div class="contenedor">
      <?php  
          echo '<div class="thumb"><a href="tarjetas.php">BUSCAR AULA <img src="imagenes/3.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="extras/aulas/" target=_blank>EDITAR AULAS<img src="imagenes/8.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="reporte_aulas.php" target=_blank>Reporte de Matriculados <img src="imagenes/7.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="imprimir.php">Imprimir <img src="imagenes/4.jpg" alt=""></a></div>';
       ?>
    </div>
  </section>

  <footer>
    <br><br>
    <p  class="copyright">Web Creada por Williams Cordova Villalva - 2K19</p>
  </footer>
</body>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>