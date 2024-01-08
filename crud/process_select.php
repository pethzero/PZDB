<?php
include("config.php");
include("systemcrud.php");
include("systemquery.php");
include("systembindParams.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ส่งค่ามาจาก หน้าบ้าน
    $queryIdHD = isset($_POST['queryIdHD']) ? $_POST['queryIdHD'] : '';
    try {
        $config_setting = database_config('server');
        $fecthData = new CRUDDATA(...$config_setting);
        $sqlQueries = new SQLQueries();
        $sqlQuery = $sqlQueries->scanSQL($queryIdHD);
         // เริ่ม Transaction
        $fecthData->data_commit->beginTransaction(); 
        $result = $fecthData->SelectRecord($sqlQuery);
        if($result['status']){
                   $fecthData->data_commit->commit();
        }else{
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
