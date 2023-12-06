<?php
include("sql.php");
include("bpdata.php");
include("crud_zen.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // ส่งค่ามาจาก หน้าบ้าน
    $queryIdHD = 'SELECT_TEST';

    try {
        // ใช้เมทอด scanSQL() เพื่อรับคำสั่ง SQL ตาม $queryId
        $sqlQueries = new SQLQueries();
        $sqlQuery = $sqlQueries->scanSQL($queryIdHD);

        if ($sqlQuery !== null) {
            $selectData = new CRUDDATA('mysql', 'localhost', 'test', 'root', '1234');
            $selectData->data_commit->beginTransaction();  // เริ่ม Transaction ดึงมาจาก class InsertData
            $result = $selectData->SelectRecordGet($sqlQuery); // ส่งค่า $message_db มาด้วย

            if ($result['status'] !== false) {
                $response = array('status' => 'success', 'datamain' => $result['result']);
                $selectData->data_commit->commit();
            } else {
                $response = array('status' => 'error', 'datamain' => $result['result']);
                $selectData->data_commit->rollBack();
            }
        } else {
            $response = array(
                'message' => 'ไม่พบคำสั่ง SQL สำหรับ $queryId ที่ระบุ',
                'datamain' => [],
                'status' => 'error',
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (Exception $e) {
        $response = array(
            'message' => $e->getMessage(),
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
