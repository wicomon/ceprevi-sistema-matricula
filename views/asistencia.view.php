<!DOCTYPE html>
<html>
<head>
  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Asistencia del aula <?php echo $_GET['aula']; ?></h1>
        <h2 >Dia : <?php echo $resultado1.' de '.$meses[$resultado-1]; ?></h2>
      </div>
    </div>
  </div>

<main role="main">
  <div class="container">
    <div class="row mt-3">
    <div class="col-md-9 mx-auto">
      <div>
        
        <?php if ($compro['fecha']==$fecha AND $compro['aula']==$aul): ?>
          <center>
            <table class="table">
             <br><br> ____________________________________________________________________________
          <h2>YA SE HA REGISTRADO ASISTENCIA ESTE DIA</h2><br>
          <a href="pre_asistencia.php" class="btn btn-danger btn-large" title="">Volver</a>
        </table>
          </center>
        <?php endif ?>

        <?php if ($compro['fecha']!==$fecha AND $compro['aula']!==$aul): ?>
                            
          <form action="" method="post">   
          <input type="hidden" name="dia" readonly class="form-control" value="<?php echo date("l",strtotime($fecha)); ?>" >
          <input type="hidden" name="mes" readonly class="form-control" value="<?php echo date("F"); ?>" >
          <input type="hidden" name="year" readonly class="form-control" value="<?php echo date("Y"); ?>" >
          
          <table class="table">
             <?php $i=1; ?>
            <?php foreach ($posts as $alumno): ?>

              <div class="form-group">
                      <input type="hidden" name="cod_<?php echo $i; ?>" readonly class="form-control" value="<?php echo $alumno['codigo']; ?>" >
                      
                  </div>

            <tr><th><label for="id_p1"><p class="h6"> <?php echo utf8_encode($i.' - '.$alumno['a_paterno'].' '.$alumno['a_materno'].' '.$alumno['nombres']); ?>  : <br/></p></label></th><td>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-primary" required>
            <input type="radio" class="form-check-input" name="p<?php echo $i; ?>" value="A" id="id_p<?php echo $i; ?>" autocomplete="off" required> Asistio</label>
            <label class="btn btn-outline-primary ">
            <input type="radio" class="form-check-input" name="p<?php echo $i; ?>" value="T" id="id_p<?php echo $i; ?>" autocomplete="off" required> Tardanza</label>
            <label class="btn btn-outline-primary ">
            <input type="radio" class="form-check-input" name="p<?php echo $i; ?>" value="F" id="id_p<?php echo $i; ?>"autocomplete="off" required > Falta</label>
            
            </div>
            </td></tr>
            <?php $i=$i+1; ?>
            <?php endforeach ?> 
          </table>

          <br>
          <center><input class="btn btn-success btn-lg" type="submit" value="enviar" /><br><br><br><br><br></center>
        </form>
        <?php endif ?>

        
      </div>
    </div>
    </div>
  </div>
  </main>
  <!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
