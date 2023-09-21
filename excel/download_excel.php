<?php
// // ระบุชื่อไฟล์ Excel ที่คุณสร้างขึ้น
// $file = 'C.xlsx';

// // ตั้งค่า header เพื่อบอกว่าเป็นไฟล์ Excel
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="' . $file . '"');
// header('Cache-Control: max-age=0');

// // อ่านและส่งไฟล์ Excel ไปยังเบราว์เซอร์
// readfile($file);
// exit;

$filename = $_GET['filename'];

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($filename);


?>
