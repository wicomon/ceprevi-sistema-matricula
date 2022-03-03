<?php
require 'fpdf/fpdf.php';
require 'funciones.php';
require_once 'models/Alumno.php';



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // Arial bold 15
    $this->SetFont('Arial','B',25);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->SetFont('Arial','I',10);
    $this->Ln(1);
    // Salto de línea
    $this->Ln(10);
}

// Pie de página

}

$cicl = $_GET['ciclo'];

$model_alumno = new Alumno();

$posts = $model_alumno->alumnos_ordenadosXciclo_alfabetico($cicl);


$fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
// Creación del objeto de la clase heredada

  $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $dia = date("d");

    // -1 porque los meses en la funcion date empiezan desde el 1
    $mes = date("m") - 1;
    $year =  date("Y");

    $fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
$a="Lima, " . $dia . " de " . $meses[$mes]. " de " . $year;

$ancho=185;
$alto= 5;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/unfv_logo.jpg',10,8,50,0);
$pdf->Image('images/logo1.jpg',150,8,50,0);
$pdf->Image('images/linea.jpg',17,30,180,1);




$pdf->SetFont('Arial','B',18);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('Relación de Alumnos matriculados'),0,1,'C');



$pdf->SetFont('Arial','B',12);
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');
$pdf->Cell(25,$alto,utf8_decode('Codigo'),1,0,'C');
$pdf->Cell(120,$alto,utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(15,$alto,utf8_decode('AULA'),1,0,'C');
$pdf->Cell(18,$alto,utf8_decode('TURNO'),1,1,'C');


$pdf->SetFont('Arial','',10);
$count=1;
    foreach ($posts as $posts ) {

        $pdf->Cell(10,$alto,$count,1,0,'C');
       $pdf->Cell(25,$alto,$posts['codigo'],1,0,'C');
       $pdf->SetFont('Arial','',8);
        $pdf->Cell(120,$alto,$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres'],1,0,'L');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,$alto,$posts['aula'],1,0,'C');
        $pdf->Cell(18,$alto,$posts['turno'],1,1,'C');
            
       
        $count++;
    }


/*$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');*/


$pdf->Output();
?>