<?php
require 'fpdf/fpdf.php';
require 'admin/config.php';
require 'funciones.php';

$conexion = conexion($bd_config);
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
    $this->Cell(0,10,utf8_decode('"Año de la Universalización de la Salud"'),0,0,'C');
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
    // Número de página
    $this->Cell(0,10,utf8_decode('Prolongación Camaná 1014, Lima. Telf. 7480888 Anexos: 9533, 9507, 9511, 9534, 9543                                        www.unfv.edu.pe/ceprevi'),0,0,'C');
}
}

$a1 = $_GET['a1'];
$a2 = $_GET['a2'];
$a3 = $_GET['a3'];


    $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN especialidades ON alumno.carrera=especialidades.cod_esp WHERE a_paterno=:paterno AND a_materno=:materno AND dni=:dni  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':paterno'=>utf8_decode($a1),':materno'=>utf8_decode($a2),':dni'=>utf8_decode($a3)));
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

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/logo1.jpg',150,8,50,0);
$pdf->Image('images/linea.jpg',17,30,180,1);

$pdf->Image('images/watermark.jpg',10,50,'');
$pdf->Image('images/watermark.jpg',10,100,'');
$pdf->Image('images/watermark.jpg',10,150,'');
$pdf->Image('images/watermark.jpg',10,200,'');

$pdf->SetFont('Arial','B',25);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('Historial de Alumno'),0,1,'C');
$pdf->Ln(10);


$pdf->SetFont('Arial','',15);
$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
$pdf->Ln(7);

$pdf->SetFont('Arial','B',17);
$pdf->Cell(0,10,$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres'],0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(5);

$pdf->Cell(20,8,utf8_decode('CODIGO'),1,0,'C');
$pdf->Cell(20,8,utf8_decode('DNI'),1,0,'C');
$pdf->Cell(15,8,utf8_decode('CICLO'),1,0,'C');
$pdf->Cell(15,8,utf8_decode('AULA'),1,0,'C');
$pdf->Cell(15,8,utf8_decode('TURNO'),1,0,'C');
$pdf->Cell(30,8,utf8_decode('SEDE'),1,0,'C');
$pdf->Cell(80,8,utf8_decode('CARRERA PROFESIONAL'),1,1,'C');


    $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN especialidades ON alumno.carrera=especialidades.cod_esp WHERE a_paterno=:paterno AND a_materno=:materno AND dni=:dni  ORDER BY a_materno,nombres");
    $sentencia->execute(array(':paterno'=>utf8_decode($a1),':materno'=>utf8_decode($a2),':dni'=>utf8_decode($a3)));
    $posts = $sentencia->fetchAll();
    

$pdf->SetFont('Arial','',10);
    
    foreach ($posts as $posts1 ) {
        $pdf->Cell(20,8,$posts1['codigo'],1,0,'C');
        $pdf->Cell(20,8,$posts1['dni'],1,0,'C');
        $pdf->Cell(15,8,$posts1['ciclo'],1,0,'C');
        $pdf->Cell(15,8,$posts1['aula'],1,0,'C');
        $pdf->Cell(15,8,$posts1['turno'],1,0,'C');
        $pdf->SetFont('Arial','',9);
        if ($posts1['sede']=='SAN JUAN DE LURIGANCHO') {
            $pdf->Cell(30,8,'SAN JUAN',1,0,'C');
        }else{
        $pdf->Cell(30,8,$posts1['sede'],1,0,'C');
        }
        $pdf->Cell(80,8,$posts1['especialidad'],1,1,'C');
        $pdf->SetFont('Arial','',10);
    }






$pdf->SetFont('Arial','',15);
$pdf->Ln(15);


$pdf->Ln(5);
$pdf->Cell($ancho,10,$a,0,1,'R');

$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');


$pdf->Output();
?>