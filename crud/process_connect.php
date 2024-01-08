<?php
include("config.php");
include("systemcrud.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $config_setting = database_config('server');
        $fecthData = new CRUDDATA(...$config_setting);
        $message = $fecthData->message_log;
        $response = array(
                    'message' => $message,
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
