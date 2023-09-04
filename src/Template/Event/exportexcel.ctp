<?php

$objPHPExcel = new PHPExcel();
// Set properties
$style = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
);
$l_bold = array(
    'font' => array(
        'bold' => true,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    ),
);
$bold = array(
    'font' => array(
        'bold' => true,
    ),
);
$r_style = array(

    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    ),
);
$l_style = array(

    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    ),
);
$v_style = array(

    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
);
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");
// Miscellaneous glyphs, UTF-8
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);


// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'S.No.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'First Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Last Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Email');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Country Code');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Mobile');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Gender');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'RSVP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Allowed Guest');

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:"."H1")->applyFromArray($style);
$row = 2;
for ($i=0; $i < 2; $i++) { 
    $gender = ($i==1) ? 'Female' : 'Male';
    $lname = ($i==1) ? 'Second' : 'First';    
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$row-1);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Dummy');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$lname);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,$lname.'@eboxtickets.com');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,'1868');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,'72XXXXX');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,$gender);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,'N');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,'N');
    $row++;
}

// Rename sheet
//$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web $colser (Excel2007)
$filename = "Attendees-sheet-(" . date('d-m-Y') . ").xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;