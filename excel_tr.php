<?php
include 'Classes/PHPExcel.php';
require_once 'includes/conexion.php';

    
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {    
    
       $cont=2;
        $sql = "SELECT 
                    t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato, t.nroCorrelativo
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    t.nroCorrelativo = p.num_correlativo"; // se hace la consulta a la base de datos
        $propuesta_t = pg_Exec($db, $sql);
        $filas = pg_numRows($propuesta_t);
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "Trabajos.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte Trabajos");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Trabajos');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','ID' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','Titulo' );
        $objPHPExcel->getActiveSheet()->setCellValue('C1','nroConsejo' );
        $objPHPExcel->getActiveSheet()->setCellValue('D1','Fecha de presentacion' );
        $objPHPExcel->getActiveSheet()->setCellValue('E1','Fecha de Aprobacion' );
        $objPHPExcel->getActiveSheet()->setCellValue('F1','Sexo' );

        for($j=0; $j<$filas; $j++){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.pg_result($propuesta_t, $j, 0));
            $objPHPExcel->getActiveSheet()->setCellValue('B'.pg_result($propuesta_t, $j, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.pg_result($propuesta_t, $j, 2));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.pg_result($propuesta_t, $j, 3));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.pg_result($propuesta_t, $j, 4));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.pg_result($propuesta_t, $j, 5));
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>