
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Ceprevi</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Barra Navegacion -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="menu.php">Menu Principal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="cerrar.php">Cerrar Sesion</a>
        </li>
        <?php if ($_SESSION['usuario'] == '666'): ?>
          <li class="nav-item">
          <a class="nav-link" href="<?php echo RUTA;?>admin/index.php">Admin</a>
        </li>
        <?php endif ?>
        
        </ul>
    </div>
  </nav>