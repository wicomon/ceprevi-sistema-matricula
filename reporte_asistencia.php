<?php
require 'fpdf/fpdf.php';
error_reporting(0);
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // Arial bold 15
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
}

function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Prolongación Camaná 1014, Lima. Telf. 7480888 Anexos: 9533, 9507, 9511, 9534, 9543                                        www.unfv.edu.pe/ceprevi'),0,0,'C');
}

}


$cod = $_GET['cod'];


        $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
        $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN asistencia ON alumno.codigo=asistencia.codigo WHERE asistencia.codigo=:cod ORDER BY mes_nro, dia_nro");
        $sentencia->execute(array(':cod'=>$cod));
        $posts = $sentencia->fetchAll();
        
        $codigo=$posts[0]['codigo'];

        $sentencia1 = $conexion->prepare("SELECT * FROM alumno WHERE codigo=:codigo");
        $sentencia1->execute(array(':codigo'=>$codigo));
        $alumno = $sentencia1->fetch();

        

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
$alto= 4;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/unfv_logo.jpg',10,8,50,0);
$pdf->Image('images/logo1.jpg',150,8,50,0);
$pdf->Image('images/linea.jpg',17,30,180,1);
$pdf->Image('images/watermark.jpg',10,50,'');
$pdf->Image('images/watermark.jpg',10,100,'');
$pdf->Image('images/watermark.jpg',10,150,'');
$pdf->Image('images/watermark.jpg',10,200,'');

$pdf->SetFont('Arial','B',20);
$pdf->Ln(7);
$pdf->Cell(0,10,utf8_decode('Reporte de Asistencia'),0,1,'C');
$pdf->Ln(1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,utf8_decode('Alumno(a) :'.$alumno['a_paterno'].' '.$alumno['a_materno'].' '.$alumno['nombres']),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Código      : '.$alumno['codigo']),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Aula          : '.$alumno['aula']),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Sede         : '.$alumno['sede']),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Ciclo         : '.$alumno['ciclo']),0,1,'L');
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
//$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');

$t=0; $a=0; $f=0; $j=0;

$pdf->SetFont('Arial','',10);
 $elmes='';

 $x=13; $y=63;
$count=0;
 $pdf->SetXY($x, $y); 
$c=0;
 $mesesito=133;
foreach ($posts as $posts ) {
    if ($posts['estado']=='T') {
        $estado='Tardanza';
        $t++;
    }
    if ($posts['estado']=='F') {
        $estado='Faltó';
        $f++;
    }
    if ($posts['estado']=='A') {
        $estado='Asistió';
        $a++;
    }
    if ($posts['estado']=='J') {
        $estado='Justificó';
        $j++;
    }
    if($mesesito==$posts['mes_nro']){
        
    }
    if($mesesito!==$posts['mes_nro']){
        $mesesito = $posts['mes_nro'];
        $y= $y+13;
        $pdf->SetFont('Arial','B',14);
        $pdf->SetXY(13, $y); 
        $pdf->Cell(20,5,UTF8_DECODE($posts['mes']),0,0,'L');
        $pdf->SetFont('Arial','',10);
        $x=13; $y=$y+5; $count=0; $c=$c+15;
    }
    if($count<=8){
        $pdf->SetXY($x, $y); 
        $pdf->Cell(20,5,$posts['dia'].' '.$posts['dia_nro'],1,0,'C');
        $pdf->SetXY($x, $y+5); 
        if ($posts['estado']=='F') {
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(20,5,UTF8_DECODE($estado),1,0,'C');
            $pdf->SetFont('Arial','',10);
        }else{
            $pdf->Cell(20,5,UTF8_DECODE($estado),1,0,'C');
        }
        $x=$x+20;
        $count++;
    }else{
        $x=13; $y=$y + 12;
        $pdf->SetXY($x, $y); 
        $pdf->Cell(20,5,$posts['dia'].' '.$posts['dia_nro'],1,0,'C');
        $pdf->SetXY($x, $y+5); 
        if ($posts['estado']=='F') {
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(20,5,UTF8_DECODE($estado),1,0,'C');
            $pdf->SetFont('Arial','',10);
        }else{
            $pdf->Cell(20,5,UTF8_DECODE($estado),1,0,'C');
        }
        $count=0; $count++;
        $x=$x+20;
    }
}

    

            /*$pdf->Cell(25,$alto,utf8_decode('Dia'),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode('Estado'),1,1,'C');  
        $pdf->Cell(100,$alto,utf8_decode($posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres']),1,0,'C');
        $pdf->Cell(15,$alto,utf8_decode($posts['aula']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($posts['dia'].' '.$posts['dia_nro']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($posts['mes']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($estado),1,1,'C');*/
    
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(15);
    $pdf->Cell(25,$alto,utf8_decode('Total de Asistencia: '.$a),0,1,'L');
    $pdf->Cell(25,$alto,utf8_decode('Total de Tardanza: '.$t),0,1,'L');
    $pdf->Cell(25,$alto,utf8_decode('Total de Justificada: '.$j),0,1,'L');
    $pdf->Cell(25,$alto,utf8_decode('Total de Falta: '.$f),0,1,'L');

/*$pdf->Ln(6);

    foreach ($posts2 as $posts ) {
        if ($posts['dia']=='Viernes') {
            $pdf->Cell(25,$alto,utf8_decode($posts['estado']),1,1,'C');
        }else{
            $pdf->Cell(25,$alto,utf8_decode($posts['estado']),1,0,'C');
        }
    }*/
      //  $pdf->Cell(10,$alto,$count,1,0,'C');

/*$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');*/


$pdf->Output();
?>