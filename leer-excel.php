<?php session_start();

require '../Classes/PHPExcel/IOFactory.php';
require 'funciones.php';
require 'admin/config.php';
require 'header.php';
require 'views/leer-excel.view.php';
$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        $statement = $conexion->prepare('INSERT INTO alumno (codigo, sede,turno, aula,ciclo, a_paterno,a_materno,nombres,dni,carrera,sexo) VALUES (:codigo, :sede,:turno, :aula,:ciclo, :a_paterno,:a_materno,:nombres,:dni,:carrera,:sexo)');
        $statement->execute(array(':codigo'=>utf8_decode($codigo),':sede'=>utf8_decode($sede),':turno'=>utf8_decode($turno),':aula'=>utf8_decode($aula),':ciclo'=>utf8_decode($ciclo), ':a_paterno'=>utf8_decode($paterno), ':a_materno'=>utf8_decode($materno),':nombres'=>utf8_decode($nombres),':dni'=>utf8_decode($dni),':carrera'=>utf8_decode($carrera),':sexo'=>utf8_decode($sexo)));
        
        
        if ($statement->rowCount() > 0)
        {
            $count++; 
        }else{
            
            echo "<center>No se inserto el código : " . $codigo."</center>";
        } 
         
    }
    echo " <center><h4>------------------------------------------------------------</h4></center>";
    echo " <center><h4>Se insertaron $count registros :)  </h4></center>";
    echo '</div>';

}



?>