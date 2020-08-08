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

$cod = $_GET['cod'];

    $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
    $sentencia = $conexion->prepare("SELECT * FROM alumno WHERE codigo=:paterno  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':paterno'=>$cod));
    $posts = $sentencia->fetchAll();
    $posts = $posts[0];

$fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
// Creación del objeto de la clase heredada

if ($posts['turno'] == 'M') {
    $turno = 'Mañana';
}else{
    $turno = 'Tarde';
}


  $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $dia = date("d");

    // -1 porque los meses en la funcion date empiezan desde el 1
    $mes = date("m") - 1;
    $year =  date("Y");

    $fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
$a="Lima, " . $dia . " de " . $meses[$mes]. " de " . $year;

$ancho=185;


$space ='                                                                                                                                     ';


$pdf=new FPDF('L','mm','A4');


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



$pdf->Output();



?>