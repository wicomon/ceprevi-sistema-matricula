<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('images/unfv_logo.jpg',10,8,50);
     $this->Ln(20);
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
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
}
}



    $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','');
    $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN economico ON alumno.codigo=economico.codigo WHERE economico.deuda='0' AND alumno.sede<>'LIMA' ORDER BY sede,aula,a_paterno,a_materno,nombres");
    $sentencia->execute();
    $posts = $sentencia->fetchAll();


$i = 0;








$ancho=185;


$space ='                                                                                                                                     ';


$pdf=new FPDF('L','mm','A4');

foreach ($posts as $posts) {
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Image('images/fotos/'.$posts['codigo'].'.jpg',250,130,40,40);  // x, y, ancho, alto
$pdf->SetFont('Arial','',17);
$pdf->Ln(122);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,$space."SEDE       : ".$posts['sede'],0,1,'L');
$pdf->Cell(0,8,$space."CODIGO  : ".$posts['codigo'],0,1,'L');
$pdf->Cell(0,8,$space."ALUMNO : ".$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres'],0,1,'L');
$pdf->Cell(0,8,$space."TURNO    : ".$posts['turno'],0,1,'L');
$pdf->Cell(0,8,$space."AULA       : ".$posts['aula'],0,1,'L');
$pdf->SetFont('Arial','',17);
$pdf->Ln(10);

}
$pdf->Output();



?>