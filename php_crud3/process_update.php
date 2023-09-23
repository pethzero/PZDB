<?php
include("database.php");
include("sql.php");
include("bpdata.php");
include("crud_update.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $queryIdHD = isset($_POST['queryIdHD']) ? $_POST['queryIdHD'] : '';
    $condition = isset($_POST['condition']) ? $_POST['condition'] : '';

    $tableData = isset($_POST['tableData']) ? $_POST['tableData'] : null;
    $tableData_Json = json_decode($tableData, true);

    $DataEdit = isset($_POST['DataEdit']) ? $_POST['DataEdit'] : null;
    $DataEdit_Json = json_decode($DataEdit, true);
    
    try {
        $sqlQueries = new SQLQueries();

        // ใช้เมทอด scanSQL() เพื่อรับคำสั่ง SQL ตาม $queryId
        $sqlQuery = $sqlQueries->scanSQL($queryIdHD);
        if ($sqlQuery !== null) {
            $updateData = new UpdateData();
            $updateData->data_commit->beginTransaction();  
            if ($updateData->updateRecord($DataEdit_Json[0], $sqlQuery, $condition)) {
                $response = array(
                    'message' => 'Data received successfully',
                    'status' => 'success'
                );
                $updateData->data_commit->commit();
            } else {
                $response = array(
                    'message' => 'Data received Error',
                    'status' => 'error'
                );
                $updateData->data_commit->rollBack();
            }
        } else {
            $response = array(
                'message' => 'ไม่พบคำสั่ง SQL สำหรับ $queryId ที่ระบุ',
                'status' => 'error',
            );
        }

        // $response = array(
        //     'message' => 'Data received successfully',
        //     'sql' =>  $sqlQuery,
        //     'DataEdit' =>  $DataEdit,
        //     'DataEdit_Json ' =>  $DataEdit_Json[0] 
        // );
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
