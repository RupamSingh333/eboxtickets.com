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
//$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
// $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
// $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
// $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
// $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);






$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'BarNo')
    ->setCellValue('B1', 'Code')
    ->setCellValue('C1', 'Descr')
    ->setCellValue('D1', 'Brand')
    ->setCellValue('E1', 'Product')
    ->setCellValue('F1', 'Color')
    ->setCellValue('G1', 'Design')
    ->setCellValue('H1', 'Dept')
    ->setCellValue('I1', 'Style')
    ->setCellValue('J1', 'MisLvl1')
    ->setCellValue('K1', 'MisLvl2')
    ->setCellValue('L1', 'MisLvl3')
    ->setCellValue('M1', 'MisLvl4')
    ->setCellValue('N1', 'MisLvl5')
    ->setCellValue('O1', 'Size')
    ->setCellValue('P1', 'SizeGroup')
    ->setCellValue('Q1', 'Unit')
    ->setCellValue('R1', 'MRP')
    ->setCellValue('S1', 'Wsp')
    ->setCellValue('T1', 'SaleRate');
  
    
$counter = 1;
     

if (isset($ticket_data) && !empty($ticket_data)) {
    foreach ($ticket_data as $i => $people) {
       //pr($people); die;
        $ii = $i + 2;

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $ii, $people['qrcode']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $ii, $people['ticket_num']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $ii, '1');
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $ii, $people['ticket']['amount']);
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $ii, '');
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $ii, $people['ticket']['amount']);
    }

}
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
$filename = "Tickerreport".$export_date.".xls";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
