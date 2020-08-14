<?php
include 'Classes/PHPExcel.php';
    
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "sistema_automatizado";
    //create connection
    $conexion = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {    
    
       $cont=2;
        $reporteCsv = $conexion
        ->query("SELECT 
                    cedula, nombre, correo_ucab, correo_part, telefono, sexo  
                FROM 
                    tesistas"); // se hace la consulta a la base de datos
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

        while($fila=$reporteCsv->fetch_assoc()){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,$fila['cedula']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,$fila['nombre']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,$fila['correo_ucab']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,$fila['correo_part']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,$fila['telefono']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cont,$fila['sexo']);
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>