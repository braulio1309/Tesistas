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
                    propuestas"); // se hace la consulta a la base de datos
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

        while($fila=$reporteCsv->fetch_assoc()){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,$fila['num_correlativo']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,$fila['titulo']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cont,$fila['f_entrega_esc']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cont,$fila['f_presentacion_comite']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cont,$fila['aprobacionComite']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cont,$fila['f_aprobacion_comite']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cont,$fila['f_aprobacion_comite']);
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>