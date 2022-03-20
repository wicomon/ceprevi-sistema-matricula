<?php
session_start();
require 'fpdf/fpdf.php';
require 'models/Alumno.php';
require 'funciones.php';
verificarPrivilegios($_SESSION['privilegios']);
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('images/unfv_logo.jpg', 10, 8, 50);
        $this->Ln(20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 25);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetFont('Arial', 'I', 10);
        $this->Ln(1);
        $this->Cell(0, 10, utf8_decode('"Año de la Universalización de la Salud"'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Prolongación Camaná 1014, Lima. Telf. 7480888 Anexos: 9533, 9507, 9511, 9534, 9543                                        www.unfv.edu.pe/ceprevi'), 0, 0, 'C');
    }
}
$cod = $_GET['cod'];

$db_conexion= new Alumno();
$posts = $db_conexion->buscar_alumno($cod);

// echo '<pre>';
// print_r($datos);
// echo '</pre>';

$fecha = strftime("%Y-%m-%d-%H-%M-%S", time());
// Creación del objeto de la clase heredada

if ($posts['turno'] == 'M') {
    $turno = 'Mañana';
} else {
    $turno = 'Tarde';
}


$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

$dia = date("d");

// -1 porque los meses en la funcion date empiezan desde el 1
$mes = date("m") - 1;
$year =  date("Y");

$fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
$a = "Lima, " . $dia . " de " . $meses[$mes] . " de " . $year;

$ancho = 185;

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/logo1.jpg', 150, 8, 50, 0);
$pdf->Image('images/linea.jpg', 17, 30, 180, 1);

$pdf->Image('images/watermark.jpg', 10, 50, '');
$pdf->Image('images/watermark.jpg', 10, 100, '');
$pdf->Image('images/watermark.jpg', 10, 150, '');
$pdf->Image('images/watermark.jpg', 10, 200, '');

$pdf->SetFont('Arial', 'B', 25);
$pdf->Ln(10);
$pdf->Cell(0, 10, utf8_decode('Constancia de Estudios'), 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 17);
if ($posts['sexo'] == 'M') {
    $pdf->Multicell($ancho, 8, utf8_decode('El Director del Centro Preuniversitario CEPREVI de la Universidad Nacional Federico Villarreal, deja constancia que el alumno: '), 0, 'J', false);
} else {
    $pdf->Multicell($ancho, 8, utf8_decode('El Director del Centro Preuniversitario CEPREVI de la Universidad Nacional Federico Villarreal, deja constancia que la alumna: '), 0, 'J', false);
}

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 17);
$pdf->Cell(0, 10, $posts['a_paterno'] . ' ' . $posts['a_materno'] . ' ' . $posts['nombres'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 17);
$pdf->Ln(10);

if ($posts['sexo'] == 'M') {
    $pdf->Multicell($ancho, 8, utf8_decode('Identificado con N° DNI:' . $posts['dni'] . ' registra matrícula en este Centro de Estudios Preuniversitario en el Ciclo ' . $posts['ciclo'] . ' , asignado al aula N° ' . $posts['aula'] . ' de la sede de ' . $posts['sede'] . ' del turno ' . $turno . ', con el código de alumno N° ' . $posts['codigo'] . '. '), 0, 'J', false);
} else {
    $pdf->Multicell($ancho, 8, utf8_decode('Identificada con N° DNI: ' . $posts['dni'] . ' registra matrícula en este Centro de Estudios Preuniversitario en el Ciclo ' . $posts['ciclo'] . ' , asignada al aula N° ' . $posts['aula'] . ' de la sede de ' . $posts['sede'] . ' del turno ' . $turno . ', con el código de alumna N° ' . $posts['codigo'] . '. '), 0, 'J', false);
}

$pdf->Ln(15);
$pdf->Multicell($ancho, 8, utf8_decode('Se expide la presente, a solicitud de la interesada para los fines que estime conveniente. '), 0, 'J', false);

$pdf->Ln(10);
$pdf->Cell($ancho, 10, $a, 0, 1, 'R');

$pdf->Ln(25);
$pdf->Cell(175, 10, 'Mg. Elena Vargas Arias', 0, 0.1, 'R');
$pdf->SetFont('Arial', '', 13);
$pdf->Cell($ancho, 10, utf8_decode('Jefa de la Oficina Académica de CEPREVI'), 0, 1, 'R');
$pdf->Ln(10);



$pdf->SetFont('Arial', '', 15);
$pdf->Cell(175, 10, utf8_decode('V°B° Dr. Pedro Vásquez García'), 0, 0.1, 'L');

$pdf->SetFont('Arial', '', 13);
$pdf->Cell($ancho, 10, utf8_decode('          Director de CEPREVI'), 0, 1, 'L');

$pdf->Image('images/linea.jpg', 17, 280, 180, 1);
$pdf->Output();
