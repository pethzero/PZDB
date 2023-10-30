<?php
$accessToken = $_POST['accessToken'];

if (isset($_POST['message'])) {
    $message = $_POST['message'];

    // URL สำหรับส่งข้อความและรูปภาพ
    $url = 'https://notify-api.line.me/api/notify';

    $stickerPackageId = $_POST['stickerPackageId'];
    $stickerId = $_POST['stickerId'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
    $image = $_FILES['image'];
    
    if ($image) {
        // กำหนดค่า POST data แบบ multipart
        $postData = array(
            'message' => $message,
            'stickerPackageId' => $stickerPackageId,
            'stickerId' => $stickerId,
            'imageFile' => curl_file_create($image['tmp_name'], $image['type'], $image['name']),
        );

        // กำหนด header รวมถึง Authorization Bearer
        $headers = array(
            'Authorization: Bearer ' . $accessToken
        );

        // ใช้ cURL เพื่อส่งคำขอ
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            echo 'ส่งข้อความและรูปภาพผ่าน LINE Notify สำเร็จ!';
        } else {
            echo 'เกิดข้อผิดพลาดในการส่งข้อความและรูปภาพผ่าน LINE Notify';
        }
    } else {
        echo 'โปรดเลือกรูปภาพที่ต้องการอัปโหลด';
    }
}
?>
