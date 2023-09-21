<?php 
$sqlsreach = array();
// ACTIVITY
$sqlsreach['IND_ACTIVITYHD'] = "INSERT INTO ACTIVITYHD (CREATED,LASTUPD,STATUS,DOCNO,CUST,CONT,CUSTNAME,CONTNAME,TEL,EMAIL,ADDR,LOCATION,SUBJECT,DETAIL,REF,PRIORITY,TIMED,TIMEH,TIMEM,STARTD,PRICECOST,PRICEPWITHDRAW,OWNER,OWNERNAME) VALUES ('NOW', 'NOW',:STATUS,:DOCNO,:CUST,:CONT,:CUSTNAME,:CONTNAME,:TEL,:EMAIL,:ADDR,:LOCATION,:SUBJECT,:DETAIL,:REF,:PRIORITY,:TIMED,:TIMEH,:TIMEM,:STARTD,:PRICECOST,:PRICEPWITHDRAW,:OWNER,:OWNERNAME)";
$sqlsreach['UPD_ACTIVITYHD'] = "UPDATE ACTIVITYHD SET LASTUPD = 'NOW', STATUS = :STATUS, CUST = :CUST, CONT = :CONT, CUSTNAME = :CUSTNAME, CONTNAME = :CONTNAME, TEL = :TEL, EMAIL = :EMAIL, ADDR = :ADDR, LOCATION = :LOCATION, SUBJECT = :SUBJECT, DETAIL = :DETAIL, REF = :REF, PRIORITY = :PRIORITY, TIMED = :TIMED, TIMEH = :TIMEH, TIMEM = :TIMEM, STARTD = :STARTD, PRICECOST = :PRICECOST, PRICEPWITHDRAW = :PRICEPWITHDRAW, OWNER = :OWNER_NUM, OWNERNAME = :OWNERNAME_STR  WHERE RECNO = :RECNO";
$sqlsreach['test'] = "SELECT * FROM  WHERE RECNO = :RECNO";

function sqlexec($queryId) 
{
  global $sqlsreach;
  if (array_key_exists($queryId, $sqlsreach))
  {
    $sqlQuery = $sqlsreach[$queryId];
    return $sqlQuery;
  } else {
    return null;
  }
}

function sqlmixexe($queryId, $params) 
{
  global $sqlsreach;
  // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
  if (array_key_exists($queryId, $sqlsreach)) {
    $sqlQuery = $sqlsreach[$queryId];
    // ตรวจสอบว่า params มีค่าหรือไม่
    if (!empty($params)) {
      // เติมค่าพารามิเตอร์ในคำสั่ง SQL
      foreach ($params as $key => $value) {
        if (isset($value) && !is_array($value)) 
        { // ตรวจสอบว่ามีคีย์ใน $params และไม่ใช่ array
          if ($value === null || $value === '') {
            $sqlQuery = str_replace(":$key", '\'\'', $sqlQuery); // แทนที่ด้วย NULL
          } else {
            $value = is_numeric($value) ? strval($value) : "'".addslashes($value)."'"; // เพิ่ม addslashes เพื่อป้องกัน SQL Injection
            $sqlQuery = str_replace(":$key", $value, $sqlQuery);
          }
        } 
      }
    }
    return $sqlQuery;
  } else {
    return null;
  }
}


// function sqlmixexe($queryId, $params) 
// {
//   global $sqlsreach;
//   // ตรวจสอบว่ามีคำสั่ง SQL ตามหมายเลขที่กำหนดหรือไม่
//   if (array_key_exists($queryId, $sqlsreach)) {
//     $sqlQuery = $sqlsreach[$queryId];
//     // ตรวจสอบว่า params มีค่าหรือไม่
//     if (!empty($params)) {
//       // เติมค่าพารามิเตอร์ในคำสั่ง SQL
//       foreach ($params as $key => $value) {
//         if (isset($value) && !is_array($value)) 
//         { // ตรวจสอบว่ามีคีย์ใน $params และไม่ใช่ array
//           if ($value === null || $value === '')
//           {
//             $value = '';
//           }else {
//             $value = is_numeric($value) ? strval($value) : "'".$value."'"; // เปลี่ยนเป็น string number ถ้าเป็นตัวเลข หรือแปลงเป็นสตริงและเพิ่มเครื่องหมาย ' (single quotes) ถ้าไม่ใช่ตัวเลข
//           }
//           $sqlQuery = str_replace(":$key", $value, $sqlQuery);
//         } 
//       }
//     }
//     return $sqlQuery;
//   } else {
//     return null;
//   }
// }

$params = [
  'ADDR' => '',
  'CONTNAME' => '',
  'CONT' => '-1',
  'CUSTNAME' => 'CANCELED บิลยกเลิก',
  'CUST' => '1',
  'DETAIL' => '',
  'EMAIL' => '',
  'LOCATION' => 'I',
  'OWNER' => '-1',
  'OWNERNAME' => '',
  'PRICECOST' => '',
  'PRICEPWITHDRAW' => '',
  'PRIORITY' => '-1',
  'REF' => '',
  'STARTD' => '2023-08-24',
  'STATUS' => 'A',
  'SUBJECT' => '',
  'TEL' => '',
  'TIMED' => '0',
  'TIMEH' => '0',
  'TIMEM' => '0'
];

// $sqlhd = sqlmixexe('IND_ACTIVITYHD', $params);
// echo $sqlhd;

?>

