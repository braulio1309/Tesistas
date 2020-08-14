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
                    profesores"; // se hace la consulta a la base de datos
         $profesor = pg_Exec($db, $sql);
         $filas = pg_numRows($profesor);
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "Tesistas.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte profesores");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Profesores');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','Cedula' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','Nombre' );
        $objPHPExcel->getActiveSheet()->setCellValue('C1','correo' );
        $objPHPExcel->getActiveSheet()->setCellValue('D1','Telefono' );
        $objPHPExcel->getActiveSheet()->setCellValue('E1','Direccion' );

        for($j=0; $j<$filas; $j++){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,pg_result($profesor, $j, 0));
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,pg_result($profesor, $j, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,pg_result($profesor, $j, 2));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,pg_result($profesor, $j, 3));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,pg_result($profesor, $j, 4));
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>