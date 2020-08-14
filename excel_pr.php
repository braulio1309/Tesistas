<?php
include 'Classes/PHPExcel.php';
require_once 'includes/conexion.php';   
    
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {    
    
       $cont=2;
        $sql = "SELECT 
                    *  
                FROM 
                    propuestas"; // se hace la consulta a la base de datos
        $propuesta = pg_Exec($db, $sql);
        $filas = pg_numRows($propuesta);
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "Propuestas.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte tesistas");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Propuestas');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','ID' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','titulo' );
        $objPHPExcel->getActiveSheet()->setCellValue('C1','Entrega escuela' );
        $objPHPExcel->getActiveSheet()->setCellValue('D1','Presentación Comite' );
        $objPHPExcel->getActiveSheet()->setCellValue('E1','Calificación' );
        $objPHPExcel->getActiveSheet()->setCellValue('F1','Fecha aprobación' );
        $objPHPExcel->getActiveSheet()->setCellValue('G1','Tipo' );

        for($j=0; $j<$filas; $j++){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,pg_result($propuesta, $j, 0));
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,pg_result($propuesta, $j, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,pg_result($propuesta, $j, 2));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,pg_result($propuesta, $j, 3));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,pg_result($propuesta, $j, 4));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cont,pg_result($propuesta, $j, 5));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cont,pg_result($propuesta, $j, 6));
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>