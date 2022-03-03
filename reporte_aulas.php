<?php
error_reporting(0);
require 'fpdf/fpdf.php';
require 'funciones.php';
require_once 'models/Alumno.php';
require_once 'models/Sedes.php';
require_once 'models/Aulas.php';


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

$model_alumno = new Alumno();
$model_sedes = new Sedes();
$model_aulas = new Aulas();

$ciclo = '2019-C';


    $alumnos = $model_alumno->alumnos_ordenadosXaula($ciclo);
   
    $sedes = $model_sedes->listar_sedes();

    $aulas = $model_aulas->listar_aulasxciclo($ciclo);
    
    $aulas_general = $model_aulas->listar_aulas_general($ciclo);
    
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
$alto= 6;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('images/unfv_logo.jpg',10,8,50,0);
$pdf->Image('images/logo1.jpg',150,8,50,0);
$pdf->Image('images/linea.jpg',17,30,180,1);




$pdf->SetFont('Arial','B',18);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('REPORTE DE MATRICULADOS '.$alumnos[0]['ciclo']),0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
//$pdf->Multicell($ancho,8,utf8_decode('Se presenta la información del alumno(a). '),0,'J',false);
/*$pdf->Cell(10,$alto,utf8_decode('N°'),1,0,'C');
$pdf->Cell(20,$alto,utf8_decode('Codigo'),1,0,'C');
$pdf->Cell(75,$alto,utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(65,$alto,utf8_decode('Carrera Profesional'),1,0,'C');
$pdf->Cell(20,$alto,utf8_decode('Pagado'),1,1,'C');*/
$count=0;
$count_aula=0;
$total_aulas=0;
$total_alumnos = 0;
$max_alumnos=0;
$max_aulas=0;
$c=1;
$y=52; $x=110;
$x1=40 ; $y1=40;
    foreach ($sedes as $sede) {
        if($c<3){
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(88,$alto,utf8_decode($sede['sede']),1,1,'L'); // despues del nombre,borde o no 1=si 0=no , salto de linea, Left right center
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(20,$alto,utf8_decode('AULA'),0,0,'C');
            $pdf->Cell(20,$alto,utf8_decode('Turno'),0,0,'C');
            $pdf->Cell(20,$alto,utf8_decode('Capacidad'),0,0,'C');
            $pdf->Cell(30,$alto,utf8_decode('Matriculados'),0,1,'C');

            $pdf->SetFont('Arial','',12);
            $sede1 = $sede['sede'];
            foreach ($aulas as $aula) {
                
                foreach ($alumnos as $alumno ) {
                    
                    if ($alumno['aula']==$aula['aula']) {
                        $count_aula++;
                        $turno = $alumno['turno'];
                        $sede = $alumno['sede'];
                        $current_aula = $alumno['aula'];
                        if ($sede==$sede1) {
                            $total_alumnos++;
                        }
                    }
                
                }
                if ($sede==$sede1) {
                    $pdf->Cell(20,$alto,utf8_decode($aula['aula']),0,0,'C');
                    $pdf->Cell(20,$alto,utf8_decode($turno),0,0,'C');
                    foreach ($aulas_general as $aul) {
                        if ($current_aula == $aul['nombre']) {
                            $pdf->Cell(20,$alto,utf8_decode($aul['capacidad']),0,0,'C');
                            $current_capacidad=$aul['capacidad'];
                        }
                    }

                    if ($current_capacidad<=$count_aula) {
                        $pdf->Cell(15,$alto,utf8_decode($count_aula),1,1,'C');
                    }else {
                        $pdf->Cell(15,$alto,utf8_decode($count_aula),0,1,'C');
                    }
                    
                    $total_aulas++;
                }
                
                $count_aula=0;
            }
            $pdf->Cell(88,$alto,utf8_decode('Total de aulas : '.$total_aulas.' -- Total Matriculados : '.$total_alumnos),1,1,'L');
            $pdf->Ln(7);
            $count=0; $c++; 
            
            $total_aulas=0;

        }else{
            $pdf->SetXY($x,$y); $y = $y +6;
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(88,$alto,utf8_decode($sede['sede']),1,1,'L'); // despues del nombre,borde o no 1=si 0=no , salto de linea, Left right center
            
           
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY($x,$y);$y = $y +6;
            $pdf->Cell(20,$alto,utf8_decode('AULA'),0,0,'C');
            $pdf->Cell(20,$alto,utf8_decode('Turno'),0,0,'C');
            $pdf->Cell(20,$alto,utf8_decode('Capacidad'),0,0,'C');
            $pdf->Cell(30,$alto,utf8_decode('Matriculados'),0,1,'C');

            $pdf->SetFont('Arial','',12);
            $sede1 = $sede['sede'];
            foreach ($aulas as $aula) {
                foreach ($alumnos as $alumno ) {
                    if ($alumno['aula']==$aula['aula']) {
                        $count_aula++;
                        $turno = $alumno['turno'];
                        $sede = $alumno['sede'];
                        $current_aula = $alumno['aula'];
                        if ($sede==$sede1) {
                            $total_alumnos++;
                        }
                    }
                
                }
                if ($sede==$sede1) {
                    $pdf->SetXY($x,$y);$y = $y +6;
                    $pdf->Cell(20,$alto,utf8_decode($aula['aula']),0,0,'C');
                    $pdf->Cell(20,$alto,utf8_decode($turno),0,0,'C');
                    foreach ($aulas_general as $aul) {
                        if ($current_aula == $aul['nombre']) {
                            $pdf->Cell(25,$alto,utf8_decode($aul['capacidad']),0,0,'C');
                            $current_capacidad=$aul['capacidad'];
                        }
                    }
                    if ($current_capacidad<=$count_aula) {
                        $pdf->Cell(15,$alto,utf8_decode($count_aula),1,1,'C');
                    }else{
                        $pdf->Cell(15,$alto,utf8_decode($count_aula),0,1,'C');
                    }
                    $total_aulas++;
                }

                
                $count_aula=0;
            }
            $pdf->SetXY($x,$y);
            $pdf->Cell(88,$alto,utf8_decode('Total de aulas : '.$total_aulas.' -- Total Matriculados : '.$total_alumnos),1,1,'L');
            $count=0; $c++; $y=$y+15;
            
            $total_aulas=0;
        }
        $total_alumnos=0;
        
        
    }

/*$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(175,10,utf8_decode('Organización y Sistemas '),0,0.1,'C');*/
    foreach ($alumnos as $alumno) {
        $max_alumnos++;
    }
    foreach ($aulas as $aula) {
        $max_aulas++;
    }
    $pdf->SetXY(30, 269); 
    $pdf->write(0,'--------------------------------------------------------------------------------------------------------------------------------------------');

    $pdf->SetXY(30, 273); 
    $pdf->write(0,'TOTAL DE ALUMNOS MATRICULADOS : '.$max_alumnos.'   ---    Total de aulas : '.$max_aulas);
    $pdf->SetXY(30, 276); 
    $pdf->write(0,'--------------------------------------------------------------------------------------------------------------------------------------------');

$pdf->Output();
?>