<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// รับข้อมูลจาก AJAX
$data = $_POST['data'];

// สร้าง Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// กำหนดข้อมูลใน Excel
for ($i = 0; $i < count($data); $i++) {
    for ($j = 0; $j < count($data[$i]); $j++) {
        $sheet->setCellValueByColumnAndRow($j + 1, $i + 1, $data[$i][$j]);
    }
}

// ตั้งค่า header เพื่อบอกว่าเป็นไฟล์ Excel
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="exported_excel.xlsx"');
// header('Cache-Control: max-age=0');

// $writer = new Xlsx($spreadsheet);
// $writer->save('php://output');
// exit;
$filename="exported_excel.xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save($filename);
// echo '<a href="C.xlsx">Download Excel</a>';
$response = array(
    'status' => 'success',
    'download' => $filename
);
echo json_encode($response);

exit;
?>
