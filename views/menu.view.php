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

  <br><br><br><br><section class="fotos">
    <div class="contenedor">
      <?php 
          echo '<div class="thumb"><a href="menu_alumno.php">A L U M N O S<img src="imagenes/2.jpg" alt=""></a></div>';    
          echo '<div class="thumb"><a href="menu_tarjetas.php"> A U L A S <img src="imagenes/3.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="subir-pagos.php"> ECONÓMICO<img src="imagenes/1.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="menu_asistencia.php">ASISTENCIA<img src="imagenes/6.jpg" alt=""></a></div>';
          echo '<div class="thumb"><a href="reporte.php"> REPORTE POR SEDE<img src="imagenes/5.jpg" alt=""></a></div>';
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