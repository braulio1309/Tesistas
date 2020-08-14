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
                    especialidades"); // se hace la consulta a la base de datos
        $objPHPExcel = new PHPExcel();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename= "especialidades.csv" ');
        $objPHPExcel->getProperties()->setCreator("Yo")->setDescription("Reporte Especialidad");
        $objPHPExcel->getActiveSheet();
        
        $objPHPExcel->getActiveSheet()->setTitle('Especialidades');
        $objPHPExcel->getActiveSheet()->setCellValue('A1','ID' );
        $objPHPExcel->getActiveSheet()->setCellValue('B1','Especialidad' );
        
        while($fila=$reporteCsv->fetch_assoc()){

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cont,$fila['id_especialidad']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cont,$fila['nombreEspecialidad']);
            
            $cont++;
        }

       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      


       
      $objWriter->save('php://output','w');

}
    

?>