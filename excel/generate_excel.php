<?php
require 'vendor/autoload.php'; // เรียกใช้งาน PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$data = $_POST['data'];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// เขียนข้อมูลลงใน Excel
foreach ($data as $row) {
    $sheet->fromArray($row, null, 'A' . ($sheet->getHighestRow() + 1));
}

$writer = new Xlsx($spreadsheet);
$filename = 'generated_excel.xlsx';
$writer->save($filename);

echo $filename;
?>
