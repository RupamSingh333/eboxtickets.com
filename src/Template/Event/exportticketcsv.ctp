<?php
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");
// Miscellaneous glyphs, UTF-8
// $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('090908');
$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'BarNo')
    ->setCellValue('B1', 'Ticket Name')
    ->setCellValue('C1', 'Ticket Amount')
    ->setCellValue('D1', 'Currency')
    ->setCellValue('E1', 'Username')
    ->setCellValue('F1', 'Ticket Print Name')
    ->setCellValue('G1', 'Email')
    ->setCellValue('H1', 'Mobile')
    ->setCellValue('I1', 'Ticket Purchase Date');
  
    
$counter = 1;
     

if (isset($ticket_data) && !empty($ticket_data)) {
    foreach ($ticket_data as $i => $people) {
       //pr($people); die;
        $ii = $i + 2;

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $ii, $people['qrcode']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $ii, $people['ticket']['eventdetail']['title']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $ii, $people['ticket']['amount']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $ii, $event_data['currency']['Currency']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $ii, $people['user']['name']." ".$people['user']['lname']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $ii, $people['name']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $ii, $people['user']['email']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $ii, $people['user']['mobile']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $ii, date('Y-m-d h:i:s',strtotime($people['created'])));
    }

}
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
$filename = $event_data['name'].$export_date.".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
