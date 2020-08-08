<?php
require 'fpdf/fpdf.php';
require 'admin/config.php';
require 'funciones.php';
//error_reporting(0);
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

$codigo = $_GET['cod'];

    $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN especialidades ON alumno.carrera = especialidades.cod_esp WHERE alumno.codigo=:codigo");
    $sentencia->execute(array(':codigo'=>$codigo));
    $posts = $sentencia->fetchAll();
    $alumno = $posts[0];

    $sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE codigo=:paterno  ORDER BY fecha DESC");
	$sentencia2->execute(array(':paterno'=>$codigo));
    $economico = $sentencia2->fetchAll();
    

$fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
// Creación del objeto de la clase heredada

if ($alumno['turno'] == 'M') {
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

$ancho=110;

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/logo1.jpg',150,8,50,0);
$pdf->Image('images/linea.jpg',17,30,180,1);

/*
$pdf->Image('images/watermark.jpg',10,50,'');
$pdf->Image('images/watermark.jpg',10,100,'');
$pdf->Image('images/watermark.jpg',10,150,'');
$pdf->Image('images/watermark.jpg',10,200,'');
*/
$pdf->Image('images/'.$alumno['ciclo'].'/fotos/'.$alumno['codigo'].'.jpg',122,60,75,0); // FOTOGRAFIA

$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,utf8_decode('Ficha de Alumno'),0,1,'C');
$pdf->Ln(5);

$altito=7;
$pdf->SetFont('Arial','I',15);
$pdf->Multicell($ancho,$altito,utf8_decode('CÓDIGO    : '.$alumno['codigo']),0,'J',false);
$pdf->Multicell($ancho,$altito,utf8_decode('DNI            : '.$alumno['dni']),0,'J',false);
$pdf->Multicell($ancho,$altito,'NOMBRE : '.$alumno['a_paterno'].' '.$alumno['a_materno'].' '.$alumno['nombres'],0,'J',false);
$pdf->Ln(1);
$pdf->Multicell($ancho,$altito,utf8_decode('ÁULA        : '.$alumno['aula']),0,'J',false);
if ($alumno['turno']=='M') {
    $pdf->Multicell($ancho,$altito,utf8_decode('TURNO    : MAÑANA'),0,'J',false);
}else{
    $pdf->Multicell($ancho,$altito,utf8_decode('TURNO    : TARDE'),0,'J',false);
}

$pdf->Multicell($ancho,$altito,utf8_decode('SEDE       : '.$alumno['sede']),0,'J',false);
$pdf->Multicell($ancho,$altito,utf8_decode('CICLO      : '.$alumno['ciclo']),0,'J',false);
$pdf->Multicell($ancho,$altito,utf8_decode('DESCTO  : '.$alumno['descuento'].'%'),0,'J',false);
$pdf->Multicell(185,$altito,('CARRERA PROFESIONAL : '.$alumno['especialidad']),0,'J',false);

$contador= 0;
foreach ($economico as $pago) { $contador++; }

if($contador > 0){
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(20,5,utf8_decode('PAGOS REALIZADOS : '),0,1,'L');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,7,utf8_decode('CÓDIGO'),1,0,'C');
    $pdf->Cell(80,7,utf8_decode('NOMBRES'),1,0,'C');
    $pdf->Cell(20,7,utf8_decode('T. PAGO'),1,0,'C');
    $pdf->Cell(25,7,utf8_decode('LIQUIDACIÓN'),1,0,'C');
    $pdf->Cell(20,7,utf8_decode('FECHA'),1,0,'C');
    $pdf->Cell(20,7,utf8_decode('MONTO'),1,1,'C');


    $pdf->SetFont('Arial','',10);
    foreach ($economico as $pago) {
        $pdf->Cell(20,7,$pago['codigo'],1,0,'C');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(80,7,$pago['nombres'],1,0,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20,7,$pago['nro_recibo'],1,0,'C');
        $pdf->Cell(25,7,$pago['liquidacion'],1,0,'C');
        $pdf->Cell(20,7,$pago['fecha'],1,0,'C');
        $pdf->Cell(20,7,utf8_decode('S/ '.$pago['monto']),1,1,'C');
    }
}


        
    

$pdf->SetFont('Arial','',15);
$pdf->Ln(15);


$pdf->Ln(5);
$pdf->Cell(185,10,$a,0,1,'R');

$pdf->Ln(20);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');


$pdf->Output();
?>