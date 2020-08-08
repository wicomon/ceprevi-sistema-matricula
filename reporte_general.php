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

$cicl = $_GET['cicl'];
$sede = $_GET['sede'];


$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:sede AND ciclo=:ciclo  ORDER BY codigo,sede,aula,a_paterno,a_materno,nombres");
$sentencia->execute(array(':sede'=>$sede,':ciclo'=>$cicl));
$posts = $sentencia->fetchAll();

$sentencia1 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo  ORDER BY codigo");
$sentencia1->execute(array(':ciclo'=>$cicl));
$posts2 = $sentencia1->fetchAll();

foreach ($posts2 as $post2) {
    $codig = $post2['codigo'];
    if(!isset($total_pago[$codig])){
        $total_pago[$codig]=0;
    }
    $total_pago[$codig] = $total_pago[$codig] + $post2['monto'];
    
}

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
$pdf->Cell(0,10,utf8_decode('SEDE : '.$sede),0,1,'C');


$pdf->SetFont('Arial','B',12);
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');
$pdf->Cell(25,$alto,utf8_decode('Codigo'),1,0,'C');
$pdf->Cell(80,$alto,utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(15,$alto,utf8_decode('AULA'),1,0,'C');
$pdf->Cell(18,$alto,utf8_decode('TURNO'),1,0,'C');
$pdf->Cell(25,$alto,utf8_decode('Pagado'),1,1,'C');


$pdf->SetFont('Arial','',10);
$count=1;
    foreach ($posts as $posts ) {

        $pdf->Cell(10,$alto,$count,1,0,'C');
       $pdf->Cell(25,$alto,$posts['codigo'],1,0,'C');
       $pdf->SetFont('Arial','',8);
        $pdf->Cell(80,$alto,$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres'],1,0,'L');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,$alto,$posts['aula'],1,0,'C');
        $pdf->Cell(18,$alto,$posts['turno'],1,0,'C');
            
        $cod = $posts['codigo'];
				if($posts['descuento']==!0){
					$descuento = 1800*$posts['descuento']/100;
					$total_a_pagar= 1830 - $descuento;
				}else{
					$total_a_pagar = 1830;
				}
				if($total_pago[$cod]<$total_a_pagar){
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(25,$alto,'S/ '.$total_pago[$cod],1,1,'C');
                    $pdf->SetFont('Arial','',10);
				}else{
                    $pdf->Cell(25,$alto,'S/ '.$total_pago[$cod],1,1,'C');
				}
       /* if ($posts['deuda']=='0') {
            $pdf->Cell(25,$alto,"BLANCO",1,1,'C');
        }
        if ($posts['deuda']==!'0') {
            $pdf->Cell(25,$alto,"AZUL",1,1,'C');
        }*/
        $count++;
    }


/*$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');*/


$pdf->Output();
?>