<?php 

$sql = array();

$sql['0001'] = "SELECT * FROM DATA";
$sql['0002'] = "SELECT * FROM DATA WHERE DATA.STATUS = ':STATUS' ";

// yon can send  $queryId example 0001
// params you can input null or params:{STATUS:'T'}

function sqlexec($queryId, $params) 
{
  global $sql;
  // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
  if (array_key_exists($queryId, $sql)) {
    $sqlQuery = $sql[$queryId];

    // ตรวจสอบว่า params มีค่าหรือไม่
    if (!empty($params)){
      // เติมค่าพารามิเตอร์ในคำสั่ง SQL
      foreach ($params as $key => $value) {
        $sqlQuery = str_replace(":$key", $value, $sqlQuery);
      }
    }

    return $sqlQuery;
  } else {
    return null;
  }
}
// function sqlexec($queryId, $params) {
//   global $sql;

//   // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
//   if (array_key_exists($queryId, $sql)) {
//     $sqlQuery = $sql[$queryId];

//     // ตรวจสอบว่า params มีค่าหรือไม่
//     if (!empty($params)){
//       // เติมค่าพารามิเตอร์ในคำสั่ง SQL
//       foreach ($params as $key => $value) {
//         // ตรวจสอบว่า value เป็นอาร์เรย์หรือไม่
//         if (is_array($value)) {
//           // สร้างสตริงเปลี่ยนแปลงให้เหมาะสมสำหรับ SQL IN clause
//           $inClause = implode(',', array_fill(0, count($value), '?'));
//           $sqlQuery = str_replace(":$key", $inClause, $sqlQuery);
//         } else {
//           $sqlQuery = str_replace(":$key", $value, $sqlQuery);
//         }
//       }
//     }

//     return $sqlQuery;
//   } else {
//     return null;
//   }
// }

// กรณี SELECT * FROM table WHERE column = :MONTHSPAN
// ELECT * FROM table WHERE column IN (?, ?, ?) หลังจากการแปลงที่ได้จาก SQL
?>

