<?php
include 'Classes/PHPExcel.php';
require_once 'includes/conexion.php';
   
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {    
    
       $cont=2;
        $sql = "SELECT 
                    cedula, nombre, correo_ucab, correo_part, telefono, sexo  
                FROM 
                    tesistas"; // se hace la consulta a la base de datos
        $tesista = pg_Exec($db, $sql);
        $filas = pg_numRows($tesista);
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "Tesistas.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte tesistas");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Tesistas');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','Cedula' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','Nombre' );
        $objPHPExcel->getActiveSheet()->setCellValue('C1','correo_ucab' );
        $objPHPExcel->getActiveSheet()->setCellValue('D1','correo_part' );
        $objPHPExcel->getActiveSheet()->setCellValue('E1','Telefono' );
        $objPHPExcel->getActiveSheet()->setCellValue('F1','Sexo' );

        for($j=0; $j<$filas; $j++){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.pg_result($tesista, $j, 0));
            $objPHPExcel->getActiveSheet()->setCellValue('B'.pg_result($tesista, $j, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.pg_result($tesista, $j, 2));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.pg_result($tesista, $j, 3));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.pg_result($tesista, $j, 4));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.pg_result($tesista, $j, 5));
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>