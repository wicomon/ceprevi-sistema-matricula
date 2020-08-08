<?php session_start();

require '../Classes/PHPExcel/IOFactory.php';
require 'funciones.php';
require 'admin/config.php';
require 'header.php';
require 'views/subir-pagos.view.php';
$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $carpeta_destino = 'excel/pagos/';
	$archivo_subido = $carpeta_destino . $_FILES['file']['name'];
	move_uploaded_file($_FILES['file']['tmp_name'], $archivo_subido);

    $nombreArchivo = $archivo_subido;

    $objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);

    $objPHPExcel->setActiveSheetIndex(0);

    $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

    $count = 0;
    echo '<br><br><div class="container border">';
    for ($i=1; $i <= $numRows ; $i++) { 
        $codigo = limpiarDatos($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());
        $nombres = limpiarDatos($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
        $nro_recibo =  $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
        $liquidacion =  $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
        $fecha =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
        $monto =  $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
        $ciclo = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
        
            $statement = $conexion->prepare('INSERT INTO economico (codigo, nombres,nro_recibo, liquidacion,fecha, monto, ciclo) VALUES (:codigo, :nombres,:nro_recibo, :liquidacion,:fecha, :monto,:ciclo)');
            $statement->execute(array(':codigo'=>utf8_decode($codigo),':nombres'=>utf8_decode($nombres),':nro_recibo'=>utf8_decode($nro_recibo),':liquidacion'=>utf8_decode($liquidacion),':fecha'=>utf8_decode($fecha), ':monto'=>utf8_decode($monto), ':ciclo'=>utf8_decode($ciclo)));
        
        

        if ($statement->rowCount() > 0)
        {
            $count++;   
        }else{
            
            echo "<center>No se inserto el código : " . $codigo." - liquidacion : ".$liquidacion."</center>";
        } 
         
    }
    echo " <center><h4>------------------------------------------------------------</h4></center>";
    echo " <center><h4>Se insertaron $count registros :)  </h4></center>";
    echo '</div>';

}



?>