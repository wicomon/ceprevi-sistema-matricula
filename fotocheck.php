<?php
require 'fpdf/fpdf.php';
require_once 'models/Alumno.php';

class PDF extends FPDF
{
    public function Header()
    {
        // Logo
        $this->Image('images/unfv_logo.jpg',0,8,50);// x, y, ancho, alto
         $this->Ln(20);
      
    }

    public function Footer()
    {
        
    }
    

   
}


$cod = $_GET['cod'];
    $model_alumno = new Alumno();
    $posts = $model_alumno->buscar_alumno($cod);

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

$ancho_total = 86;
$alto_total= 55;
$space ='';
$pdf=new FPDF('L','mm',array($ancho_total,$alto_total));



$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/fotocheck.jpg',0,0,$ancho_total,$alto_total);
//$pdf->Image('images/logo1.jpg',2,2,30,8);
$pdf->Image('images/'.$posts['ciclo'].'/fotos/'.$posts['codigo'].'.jpg',2,12,28,30);  // x, y, ancho, alto

$pdf->SetFont('Arial','B',15);
$pdf->SetXY(33, 4); 
$pdf->write(0,$posts['ciclo']);
$pdf->SetFont('Arial','B',11);
$pdf->SetXY(30, 15); 
//$pdf->write(0,$posts['a_paterno'].' '.$posts['a_materno'].',');
$pdf->Multicell(55,4,$posts['a_paterno'].' '.$posts['a_materno'].', '.$posts['nombres'],0,'L',false);

$pdf->SetXY(30, 29); 
$pdf->write(0,utf8_decode('Código : '.$posts['codigo']));
if($posts['sede']=='SAN JUAN DE LURIGANCHO')
{
    $pdf->SetXY(30, 33); 
    $pdf->write(0,'Sede     : SAN JUAN');
}else{
    $pdf->SetXY(30, 33); 
    $pdf->write(0,'Sede     : '.$posts['sede']);
}



/*$pdf->Cell(0,7,$space."SEDE       : ".$posts['sede']);
$pdf->ln();
$pdf->SetXY(0, 19); 
$pdf->write(0,$space."CODIGO  : ".$posts['codigo']);
$pdf->ln();
$pdf->Cell(0,7,$space."NOMBRE : ".$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres']);
$pdf->ln();
$pdf->Write(0,$space."TURNO    : ".$posts['turno'],0,1,'L');
$pdf->ln();
$pdf->Cell(0,7,$space."AULA       : ".$posts['aula']);
$pdf->ln(15);
$pdf->Write(0,$space."".$posts['carrera'],0,1,'L');*/

//$pdf->SetXY(10, 39); 
//$pdf->Write(0, "Event Name");

/*$pdf->Ln(122);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,$space."SEDE       : ".$posts['sede'],0,1,'L');
$pdf->Cell(0,8,$space."CODIGO  : ".$posts['codigo'],0,1,'L');
$pdf->Cell(0,8,$space."ALUMNO : ".$posts['a_paterno'].' '.$posts['a_materno'].' '.$posts['nombres'],0,1,'L');
$pdf->Cell(0,8,$space."TURNO    : ".$posts['turno'],0,1,'L');
$pdf->Cell(0,8,$space."AULA       : ".$posts['aula'],0,1,'L');
$pdf->SetFont('Arial','',17);
$pdf->Ln(10);*/



$pdf->Output();



?>