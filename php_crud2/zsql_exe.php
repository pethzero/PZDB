<?php

$sqlsreach = array();
$sqlsreach['TEST'] = "SELECT * FROM TEST WHERE RECNO = :RECNO AND DATA = :DATA  AND X = :X NUMBER = :NUMBER ";

$sqlsreach['HIS43'] = "SELECT * FROM his";
$sqlsreach['INSERT_HIS43'] = "INSERT INTO his (name, id, age) VALUES (:value1, :value2, :value3)";

function sqlexec($queryId)
{
  global $sqlsreach;
  if (array_key_exists($queryId, $sqlsreach)) {
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
        if (isset($value) && !is_array($value)) { // ตรวจสอบว่ามีคีย์ใน $params และไม่ใช่ array
          if ($value === null || $value === '') {
            $sqlQuery = str_replace(":$key", '\'\'', $sqlQuery); // แทนที่ด้วย NULL
          } else {
            $value = is_numeric($value) ? strval($value) : "'" . addslashes($value) . "'"; // เพิ่ม addslashes เพื่อป้องกัน SQL Injection
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
