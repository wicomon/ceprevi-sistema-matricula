<?php
require 'fpdf/fpdf.php';

require 'funciones.php';
require_once 'models/Alumno.php';
require_once 'models/Economico.php';

class PDF extends FPDF  {
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

$color = $_GET['color'];
$cicl = $_GET['cicl'];
$sede = $_GET['sede'];

$model_alumno = new Alumno();
$model_economico = new Economico();

        $post = $model_alumno->alumnos_por_sede_ciclo($sede, $cicl);

        $post2 = $model_economico->listado_por_ciclo_fecha($cicl);

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




$pdf->SetFont('Arial','B',14);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('LISTADO DE ALUMNOS DE LA SEDE  : '.$post[0]['sede']),0,1,'C');


$pdf->SetFont('Arial','B',12);
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');
$pdf->Cell(20,$alto,utf8_decode('Codigo'),1,0,'C');
$pdf->Cell(90,$alto,utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(20,$alto,utf8_decode('Aula'),1,0,'C');
$pdf->Cell(17,$alto,utf8_decode('Pagado'),1,0,'C');
$pdf->Cell(17,$alto,utf8_decode('Dscto'),1,0,'C');
$pdf->Cell(20,$alto,utf8_decode('Tarjeta'),1,1,'C');


$pdf->SetFont('Arial','',10);
$count=1; $monto_tot = 0; $descuentos = 0; $total_a_pagar=0;
    foreach ($post as $alumno ) {
        $pdf->SetFont('Arial','',10);
        
		foreach ($post2 as $economico ){
				if ($economico['codigo'] == $alumno['codigo'] ){
					$monto_tot = $monto_tot + $economico['monto'];
                }
				if($alumno['descuento']==!0){
                    $descuentos = 1800*$alumno['descuento']/100;
					$total_a_pagar= 1830 - $descuentos;
				}else{
					$total_a_pagar = 1830;
                }
        }

       
        
        if ($total_a_pagar <= $monto_tot && $color=='blanca') {
            $pdf->Cell(10,$alto,$count,1,0,'C');
            $pdf->Cell(20,$alto,$alumno['codigo'],1,0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(90,$alto,$alumno['a_paterno'].' '.$alumno['a_materno'].' '.$alumno['nombres'],1,0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,$alto,$alumno['aula'],1,0,'C');
            $pdf->Cell(17,$alto,$monto_tot,1,0,'C');
            if ($alumno['descuento']==!0) {
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(17,$alto,$alumno['descuento'].'%',1,0,'C');
                $pdf->SetFont('Arial','',8);
            }else{
                $pdf->Cell(17,$alto,$alumno['descuento'].'%',1,0,'C');
            }
            $pdf->Cell(20,$alto,'Blanca',1,1,'C');
            $count++;
        }
        if ($total_a_pagar > $monto_tot && $color=='color' ) {
            $pdf->Cell(10,$alto,$count,1,0,'C');
            $pdf->Cell(20,$alto,$alumno['codigo'],1,0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(90,$alto,$alumno['a_paterno'].' '.$alumno['a_materno'].' '.$alumno['nombres'],1,0,'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20,$alto,$alumno['aula'],1,0,'C');
            $pdf->Cell(17,$alto,$monto_tot,1,0,'C');
            if ($alumno['descuento']==!0) {
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(17,$alto,$alumno['descuento'].'%',1,0,'C');
                $pdf->SetFont('Arial','',8);
            }else{
                $pdf->Cell(17,$alto,$alumno['descuento'].'%',1,0,'C');
            }
            $pdf->Cell(20,$alto,'Color',1,1,'C');
            $count++;
        }
        
        
        $monto_tot = 0;
    }


/*$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');*/


$pdf->Output();
?>