<?php 

$sql = array();

$sql['IND_ACTIVITYHD'] = "INSERT INTO ACTIVITYHD (RECNO, CREATED, LASTUPD,STATUS,DOCNO,CUST, CONT,CUSTNAME,CONTNAME) VALUES (:RECNO, 'NOW', 'NOW',':STATUS',':DOCNO' , :CUST , :CONT ,':CUSTNAME', ':CONTNAME')";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// function sqlexec($queryId, $params) 
// {
//   global $sql;
//   // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
//   if (array_key_exists($queryId, $sql)) {
//     $sqlQuery = $sql[$queryId];
//     // ตรวจสอบว่า params มีค่าหรือไม่
//     if (!empty($params))
//     {
//       // เติมค่าพารามิเตอร์ในคำสั่ง SQL
//       foreach ($params as $key => $value) {
//         if ($value === null || $value === '') {
//           $value = 'NULL';
//         }
//         $sqlQuery = str_replace(":$key", $value, $sqlQuery);
//       }
//     }
//     return $sqlQuery;
//   } else {
//     return null;
//   }
// }
function sqlexec($queryId, $params) 
{
  global $sql;
  // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
  if (array_key_exists($queryId, $sql)) {
    $sqlQuery = $sql[$queryId];
    // ตรวจสอบว่า params มีค่าหรือไม่
    if (!empty($params))
    {
      // เติมค่าพารามิเตอร์ในคำสั่ง SQL
      foreach ($params as $key => $value) {
        // ในกรณีที่ค่าเป็นตัวเลขหรือ NULL ให้ไม่ใส่เครื่องหมายคำพูดใน SQL query
        if (is_numeric($value) || $value === null) {
          $sqlQuery = str_replace(":$key", $value, $sqlQuery);
        } else {
          // ในกรณีที่ค่าเป็นสตริงให้ใส่เครื่องหมายคำพูดใน SQL query
          $sqlQuery = str_replace(":$key", "'$value'", $sqlQuery);
        }
      }
    }
    return $sqlQuery;
  } else {
    return null;
  }
}

$params = [
  'RECNO' => '',
  'STATUS' => -1, // สมมุติว่ามีการส่งค่า status มาจาก JavaScript
  'CUSTNAME' => 'ว้าว',
  'CONTNAME' => 'what', // สมมุติว่ามีการส่งค่า contname มาจาก JavaScript
  'CUST' => 20,
  'CONT' => 30,
];

$sqlhd = sqlexec('IND_ACTIVITYHD', $params);
echo $sqlhd;

// echo iconv("UTF-8", "TIS-620//TRANSLIT//IGNORE", $params['CUSTNAME']);
// $paramhd['CUSTNAME'] = iconv("UTF-8", "TIS-620//TRANSLIT//IGNORE", $value);
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

