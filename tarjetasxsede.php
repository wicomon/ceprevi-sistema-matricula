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

$sede = $_GET['aul'];
$cicl = $_GET['cicl'];
$color =$_GET['color'];

$conexion = new PDO('mysql:host=localhost;dbname=ceprevi','root','ceprevi2020');
$sentencia = $conexion->prepare("SELECT * FROM alumno WHERE sede=:sede AND ciclo=:ciclo ORDER BY sede,aula,a_paterno,a_materno,nombres");
$sentencia->execute(array(':sede'=>$sede,':ciclo'=>$cicl));
$alumno = $sentencia->fetchAll();

$sentencia2 = $conexion->prepare("SELECT * FROM economico WHERE ciclo=:ciclo ORDER BY codigo,nombres");
$sentencia2->execute(array(':ciclo'=>$cicl));
$economico = $sentencia2->fetchAll();
        
$c=1; $monto_pagado=0; $total_a_pagar=0;
$i = 0;
$ancho=185;
$space ='                                                                                                                                     ';

$pdf=new FPDF('L','mm','A4');

    foreach ($alumno as $alumno1) {
        foreach ($economico as $economico1) {
            if ($alumno1['codigo'] == $economico1['codigo']) {
                $monto_pagado = $monto_pagado + $economico1['monto'];
            }
        }
        if($alumno1['descuento']==!0){
            $descuento = 1800*$alumno1['descuento']/100;
            $total_a_pagar= 1830 - $descuento;
        }else{
            $total_a_pagar = 1830;
        }

        if ($color=='BLANCA' && $total_a_pagar<=$monto_pagado ) {
            $pdf->AliasNbPages();
            $pdf->AddPage();
            //$pdf->Image('images/fotos/'.$posts['codigo'].'.jpg',250,130,40,40);  // x, y, ancho, alto
            $pdf->SetFont('Arial','',17);
            $pdf->Ln(122);
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(0,8,$space."SEDE       : ".$alumno1['sede'],0,1,'L');
            $pdf->Cell(0,8,$space."CODIGO  : ".$alumno1['codigo'],0,1,'L');
            $pdf->Cell(0,8,$space."ALUMNO : ".$alumno1['a_paterno'].' '.$alumno1['a_materno'].' '.$alumno1['nombres'],0,1,'L');
            $pdf->Cell(0,8,$space."TURNO    : ".$alumno1['turno'],0,1,'L');
            $pdf->Cell(0,8,$space."AULA       : ".$alumno1['aula'],0,1,'L');
            $pdf->SetFont('Arial','',17);
            $pdf->Ln(10);
        }
        if ($color=='COLOR' && $total_a_pagar > $monto_pagado ) {
            $pdf->AliasNbPages();
            $pdf->AddPage();
            //$pdf->Image('images/fotos/'.$posts['codigo'].'.jpg',250,130,40,40);  // x, y, ancho, alto
            $pdf->SetFont('Arial','',17);
            $pdf->Ln(122);
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(0,8,$space."SEDE       : ".$alumno1['sede'],0,1,'L');
            $pdf->Cell(0,8,$space."CODIGO  : ".$alumno1['codigo'],0,1,'L');
            $pdf->Cell(0,8,$space."ALUMNO : ".$alumno1['a_paterno'].' '.$alumno1['a_materno'].' '.$alumno1['nombres'],0,1,'L');
            $pdf->Cell(0,8,$space."TURNO    : ".$alumno1['turno'],0,1,'L');
            $pdf->Cell(0,8,$space."AULA       : ".$alumno1['aula'],0,1,'L');
            $pdf->SetFont('Arial','',17);
            $pdf->Ln(10);
        }
        $monto_pagado=0;
    }
/*
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

}*/
$pdf->Output();



?>