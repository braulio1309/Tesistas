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
                    t.id_tg, p.titulo, t.nroConsejo, t.Fecha_presentacion, t.horaPresentacion, t.fechaAprobacion, t.tipo_formato, t.nroCorrelativo
                FROM 
                    trabajos t, propuestas p 
                WHERE 
                    t.nroCorrelativo = p.num_correlativo"); // se hace la consulta a la base de datos
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

        while($fila=$reporteCsv->fetch_assoc()){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,$fila['id_tg']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,$fila['titulo']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,$fila['nroConsejo']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,$fila['Fecha_presentacion']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,$fila['horaPresentacion']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cont,$fila['fechaAprobacion']);
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>