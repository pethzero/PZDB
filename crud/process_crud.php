<?php
include("config.php");
include("systemcrud.php");
include("systemquery.php");
include("systembindParams.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ส่งค่ามาจาก หน้าบ้าน
    $method = isset($_POST['method']) ? $_POST['method'] : '';
    $queryIdHD = isset($_POST['queryIdHD']) ? $_POST['queryIdHD'] : '';
    $condition = isset($_POST['condition']) ? $_POST['condition'] : '';
    $apiData = isset($_POST['apidata']) ? $_POST['apidata'] : null;
    $apiData_Json = json_decode($apiData, true);
    try {
        $config_setting = database_config('server');  //config เลือก server
        $fecthData = new CRUDDATA(...$config_setting); //เรียกใช้ class เชื่อมต่อ DataBase
        $sqlQueries = new SQLQueries(); //เรียกใช้ class ค้นหาคำศัพท์ Query
        $sqlQuery = $sqlQueries->scanSQL($queryIdHD);
        // เริ่ม Transaction
        $fecthData->data_commit->beginTransaction();
        if ($method === 'R') {
            $result = $fecthData->SelectRecordCondition($apiData_Json[0], $sqlQuery, $condition);
        } else if ($method === 'C') {
            $result = $fecthData->insertRecord($apiData_Json[0], $sqlQuery, $condition);
        } else if ($method === 'U') {
            $result = $fecthData->updateRecord($apiData_Json[0], $sqlQuery, $condition);
        } else if ($method === 'D') {
            $result = $fecthData->deleteRecord($apiData_Json[0], $sqlQuery, $condition);
        }



        if ($result['status']) {
            $fecthData->data_commit->commit();
        } else {
            $fecthData->data_commit->rollBack();
        }
        $response = array(
            'message' => 'Data suscess',
            'data' =>  $result,
            'status' => 'suscess',
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (Exception $e) {
        $response = array(
            'message error' => $e->getMessage(),
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
