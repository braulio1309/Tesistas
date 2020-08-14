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
                    especialidades"; 
        $especialidad = pg_Exec($db, $sql);
        $filas = pg_numRows($especialidad);
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "especialidades.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte Especialidad");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Especialidades');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','ID' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','Especialidad' );
        
        for($j=0; $j<$filas; $j++){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,pg_result($especialidad, $j, 0));
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,pg_result($especialidad, $j, 1));
            
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>