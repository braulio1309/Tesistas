<?php 
    require_once 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT 
                pr.num_correlativo, p.nombreProfe, p.direccionProfe, p.cedula_profe, p.correoProfe, pr.titulo, pr.tipo_propuesta, tr.nroConsejo
            FROM 
                profesores p, propuestas pr, trabajos tr
            WHERE 
                pr.cedula_profe = p.cedula_profe AND
                tr.nroCorrelativo = pr.num_correlativo AND
                tr.id_tg = $id";
    $trabajo = pg_Exec($db, $sql);

    $correlativo = pg_result($trabajo, 0, 0);

    $sql1 = "SELECT 
                t.nombre, t.cedula, t.telefono, t.correo_part, t.correo_ucab
            FROM 
               presentan pr, tesistas t
            WHERE 
                t.cedula = pr.cedulaTesista AND
                pr.nroCorrelativo= $correlativo";
    $tesistas = pg_Exec($db, $sql1); 

    require('./fpdf.php');
 
    /*$pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(20,10,pg_result($trabajo,0, 5));
    $pdf->Cell(10,60,'Nombre del tesista:');
    $pdf->Cell(10,120,'Nombre del tutor:');
    $pdf->Cell(10,180,'Criterios:');


    $pdf->Output(); */




    class PDF extends FPDF
{
// Cargar los datos

// Tabla simple
function BasicTable($header, $data, $info)
{
    // Cabecera
    $this->Cell(40,6,'Datos de'.$info, 0,1);

    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Datos
    for($j = 0; $j<pg_numRows($data); $j++)
    {
        
        $this->Cell(40,6,pg_result($data, $j, 0),1);
        $this->Cell(40,6,pg_result($data, $j, 1),1);
        $this->Cell(40,6,pg_result($data, $j, 2),1);
        $this->Cell(40,6,pg_result($data, $j, 3),1);

        $this->Ln();
    }
}




}

$pdf = new PDF();
// Títulos de las columnas
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

$pdf->Cell(40,6,pg_result($trabajo,0, 5).'-'.pg_result($trabajo,0, 6) , 0,1);

$header = array('Cedula', 'Nombre', 'Direccion', 'Correo');
// Carga de datos
$data = $tesistas;

$pdf->BasicTable($header,$data, 'Tesistas');
$data = $trabajo;
$header = array('ID', 'TUTOR', 'Direccion', 'Cedula');

$pdf->BasicTable($header,$data, 'Tutor');


$pdf->AddPage();
$pdf->Output();
?>