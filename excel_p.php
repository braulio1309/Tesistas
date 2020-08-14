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
                    *  
                FROM 
                    profesores"); // se hace la consulta a la base de datos
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

        while($fila=$reporteCsv->fetch_assoc()){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,$fila['cedula_profe']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,$fila['nombreProfe']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,$fila['correoProfe']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,$fila['telefonoProfe']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,$fila['direccionProfe']);
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>