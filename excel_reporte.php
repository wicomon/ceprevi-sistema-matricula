<?php 
require 'admin/config.php';
require 'funciones.php';
require_once '../../PHPEXCEL/Classes/PHPExcel.php';



$cod = $_GET['cod'];


        $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
        $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN asistencia ON alumno.codigo=asistencia.codigo WHERE asistencia.codigo=:cod ORDER BY fecha");
        $sentencia->execute(array(':cod'=>$cod));
        $posts = $sentencia->fetchAll();
        





$objPHPExcel = new PHPExcel();

// Set document properties

    $objSheet = $objPHPExcel->setActiveSheetIndex(0);
/*
    $objSheet->setCellValueExplicitByColumnAndRow(0, 1, 'CODIGO DE ALUMNO', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(1, 1, 'CURSO', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(2, 1, 'CODIGO DOCENTE', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(3, 1, 'AULA', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(4, 1, 'P1', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(5, 1, 'P2', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(6, 1, 'P3', PHPExcel_Cell_DataType::TYPE_STRING); 
    $objSheet->setCellValueExplicitByColumnAndRow(7, 1, 'P4', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(8, 1, 'P5', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(9, 1, 'P6', PHPExcel_Cell_DataType::TYPE_STRING);  
	$objSheet->setCellValueExplicitByColumnAndRow(10, 1, 'P7', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(11, 1, 'P8', PHPExcel_Cell_DataType::TYPE_STRING);
    $objSheet->setCellValueExplicitByColumnAndRow(12, 1, 'P9', PHPExcel_Cell_DataType::TYPE_STRING);  
	$objSheet->setCellValueExplicitByColumnAndRow(13, 1, 'P10', PHPExcel_Cell_DataType::TYPE_STRING); 
*/


$i =2;
$a= 1;


foreach ($posts as $row) {

        if ($row['dia']=='Viernes') {
            $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['dia'].' '.$row['dia_nro'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicitByColumnAndRow($a,$i+1, $row['estado'], PHPExcel_Cell_DataType::TYPE_STRING);
            $a=0;
            $i=$i+3;
        }else{
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['dia'].' '.$row['dia_nro'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i+1, $row['estado'], PHPExcel_Cell_DataType::TYPE_STRING);
        }

       /* $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['curso'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['cod_prof'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['cod_aula'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p1'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p2'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p3'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p4'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p5'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p6'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p7'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p8'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p9'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
        $objSheet->setCellValueExplicitByColumnAndRow($a,$i, $row['p10'], PHPExcel_Cell_DataType::TYPE_NUMERIC);*/

$a++;
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setTitle('Informe de Encuestas');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Encuesta.xls"');
    header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>