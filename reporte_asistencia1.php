<?php
require 'fpdf/fpdf.php';

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


$cod = $_GET['cod'];


        $conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
        $sentencia = $conexion->prepare("SELECT * FROM alumno INNER JOIN asistencia ON alumno.codigo=asistencia.codigo WHERE asistencia.codigo=:cod ORDER BY fecha");
        $sentencia->execute(array(':cod'=>$cod));
        $posts = $sentencia->fetchAll();
        
        $sentencia1 = $conexion->prepare("SELECT DISTINCT mes FROM asistencia ORDER BY mes");
        $sentencia1->execute(array(':cod'=>$cod));
        $posts1 = $sentencia1->fetchAll();

        

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


$pdf->SetFont('Arial','B',18);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('Reporte de Asistencia'),0,1,'C');
$pdf->Ln(5);


$pdf->SetFont('Arial','B',12);
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
//$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');

$t=0; $a=0; $f=0;

$pdf->SetFont('Arial','B',8);

    $pdf->Cell(100,$alto,utf8_decode('NOMBRE'),1,0,'C');
    $pdf->Cell(15,$alto,utf8_decode('AULA'),1,0,'C');
    $pdf->Cell(25,$alto,utf8_decode('DIA'),1,0,'C');
    $pdf->Cell(25,$alto,utf8_decode('MES'),1,0,'C');
    $pdf->Cell(25,$alto,utf8_decode('ESTADO'),1,1,'C');
    $pdf->SetFont('Arial','',9);

 $elmes='';

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
            $a++;
        }

        /*$pdf->Cell(25,$alto,utf8_decode('Dia'),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode('Estado'),1,1,'C');  */
        $pdf->Cell(100,$alto,utf8_decode($posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres']),1,0,'C');
        $pdf->Cell(15,$alto,utf8_decode($posts['aula']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($posts['dia'].' '.$posts['dia_nro']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($posts['mes']),1,0,'C');
        $pdf->Cell(25,$alto,utf8_decode($estado),1,1,'C');
    }
    
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(6);
    $pdf->Cell(25,$alto,utf8_decode('Total de Asistencias: '.$a),0,1,'L');
    $pdf->Cell(25,$alto,utf8_decode('Total de Tardanzas: '.$t),0,1,'L');
    $pdf->Cell(25,$alto,utf8_decode('Total de Faltas: '.$f),0,1,'L');

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