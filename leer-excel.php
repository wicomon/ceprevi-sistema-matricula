<?php session_start();

require '../Classes/PHPExcel/IOFactory.php';
require 'funciones.php';
require 'header.php';
require 'views/leer-excel.view.php';
require_once 'models/Alumno.php';

verificarPrivilegios($_SESSION['privilegios']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = new Alumno();

    $carpeta_destino = 'excel/';
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
        $sede = limpiarDatos($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
        $turno =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());
        $aula =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());
        $ciclo =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
        $paterno =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
        $materno =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue());
        $nombres =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
        $dni =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue());
        $carrera =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue());
        $sexo =  limpiarDatos($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue());

        $insertado = $conexion->insertar_alumno($codigo,$dni,$carrera,$nombres,$paterno,$materno,$sexo,$turno,$aula,$ciclo,$sede);

        if ($insertado > 0)
        {
            $count++; 
        }else{
            
            echo "<center>No se inserto el código : $codigo - $nombres - $paterno $materno </center>";
        } 
         
    }
    echo " <center><h4>------------------------------------------------------------</h4></center>";
    echo " <center><h4>Se insertaron $count registros :)  </h4></center>";
    echo '</div>';

}



?>