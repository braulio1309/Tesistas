<?php 
    require_once 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT 
                pr.num_correlativo, p.nombreProfe, p.direccionProfe, p.cedula_profe, p.correoProfe, pr.titulo, pr.tipo_propuesta, tr.nroConsejo, tr.tipo_formato
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

    if(pg_result($trabajo, 0, 6) == 'Instrumental'){
        $id_formato = pg_result($trabajo,0, 8);
       
        $sql = "SELECT criterios, criterios, criterios, criterios FROM criterios_jurado_tig WHERE id_formato = '$id_formato'";
        //var_dump($sql);die();

        $formato = pg_Exec($db, $sql); 

    }else{
        $id_formato = pg_result($trabajo,0, 8);
        $sql = "SELECT criterios, criterios, criterios, criterios FROM criterios_jurado_teg WHERE id_formato = '$id_formato'";
        //var_dump($sql);die();
        $formato = pg_Exec($db, $sql); 

    }

    $sql = "SELECT 
                p.cedula_profe, p.nombreProfe, p.correoProfe, p.direccionProfe
            FROM 
                es_jurado , profesores p
            WHERE 
                (jurado_profe1 =p.cedula_profe OR 
                jurado_profe2 = p.cedula_profe OR 
                jurado_profe3 = p.cedula_profe OR 
                jurado_profe4 = p.cedula_profe) AND
                id_tg = $id";
    $jurados = pg_Exec($db, $sql); 


    require('./fpdf.php');
 

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

$pdf->Ln();

$pdf->BasicTable($header,$data, 'Tesistas');
$data = $trabajo;
$header = array('ID', 'TUTOR', 'Direccion', 'Cedula');

$pdf->Ln();

$pdf->BasicTable($header,$data, 'Tutor');

$header = array('Criterios a evaluar');
$data = $formato;
$pdf->BasicTable($header,$data, 'Criterios');

$pdf->Ln();
$header = array('Cedula', 'Nombre', 'correo', 'direccion');
$data = $jurados;
$pdf->BasicTable($header,$data, 'jurados');



$pdf->AddPage();
$pdf->Output();
?>