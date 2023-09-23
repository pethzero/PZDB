<?php
include("database.php");
include("sql.php");
include("bpdata.php");
include("crud_delete.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $queryIdHD = isset($_POST['queryIdHD']) ? $_POST['queryIdHD'] : '';
    $condition = isset($_POST['condition']) ? $_POST['condition'] : '';

    // $tableData = isset($_POST['tableData']) ? $_POST['tableData'] : null;
    // $tableData_Json = json_decode($tableData, true);

    $DataRemove = isset($_POST['DataRemove']) ? $_POST['DataRemove'] : null;
    $DataRemove_Json = json_decode($DataRemove, true);
    
    try {
        $sqlQueries = new SQLQueries();

        // ใช้เมทอด scanSQL() เพื่อรับคำสั่ง SQL ตาม $queryId
        $sqlQuery = $sqlQueries->scanSQL($queryIdHD);

        if ($sqlQuery !== null) {

            $deleteData = new DeleteData();
            $deleteData->data_commit->beginTransaction();  

            if ($deleteData->deleteRecord($DataRemove_Json[0], $sqlQuery, $condition)) {
                $response = array('message' => 'Data received successfully','status' => 'success');
                $deleteData->data_commit->commit();
            } else {
                $response = array('message' => 'Data received Error','status' => 'error');
                $deleteData->data_commit->rollBack();
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
        //     'DataRemove' =>  $DataRemove,
        //     'DataRemove ' =>  $DataRemove_Json[0] 
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
