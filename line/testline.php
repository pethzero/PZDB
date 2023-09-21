<?php
$lineAccessToken = 'hak3jFYGGnD6DkfdWrkSvbOB52S1mVzbobDUysGN/SyFMce+59Hy02CdiZmBK0EIzIRFgXK6FovENzQ6C60B3yldjXrEaiPfGqjJF0plHXimbiMB4zBs/YTdLU8NEVzwAChFWPE+TA28kqByby2etwdB04t89/1O/w1cDnyilFU='; // ใส่ค่า Access Token ของคุณที่นี่

function sendLineMessage($message) {
    global $lineAccessToken;
    $lineApiUrl = 'https://api.line.me/v2/bot/message/push';
    
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $lineAccessToken
    );
    
    $data = array(
        'to' => 'YOUR_LINE_USER_ID', // ใส่ User ID ของผู้รับที่นี่
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $message
            )
        )
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $lineApiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

// เรียกใช้ฟังก์ชันส่งข้อความไปยัง Line
$message = 'สวัสดี Line!';
$response = sendLineMessage($message);

// ตรวจสอบผลลัพธ์
if ($response === false) {
    echo 'เกิดข้อผิดพลาดในการส่งข้อความ';
} else {
    echo 'ส่งข้อความไปยัง Line สำเร็จแล้ว';
}
?>
