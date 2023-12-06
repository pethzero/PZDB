<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ส่งค่ามาจาก หน้าบ้าน
    $Param = isset($_POST['Param']) ? $_POST['Param'] : null;
    $Param_Json = json_decode($Param, true);
    // // อ่านข้อมูล JSON จากไฟล์ data.json
    $jsonData = file_get_contents('data.json');
    // // แปลง JSON เป็น associative array
    $dataArray = json_decode($jsonData, true);
    // รับค่า datasetting จาก Param_Json
    $newSettingValue = $Param_Json[0]['datasetting'];
    // // แก้ไขค่า datasetting
    $dataArray['datasetting'] = $newSettingValue;
    // แปลง associative array เป็น JSON ใหม่
    $newJsonData = json_encode($dataArray);
    // เขียนข้อมูล JSON กลับไปยังไฟล์ data.json
    file_put_contents('data.json', $newJsonData);
    // ส่งค่าที่แก้ไขแล้วกลับให้กับ JavaScript
    echo json_encode(['success' => true,'data'=>$newSettingValue ]);
}
