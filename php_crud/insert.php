<?php
$host = 'localhost';
$db_name = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงค่า Auto Increment ล่าสุดที่เพิ่มเข้ามาในฐานข้อมูล
    $query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = 'his'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $autoIncrementValue = $row['AUTO_INCREMENT'];

    // กำหนดความยาวที่ต้องการ
    $desiredLength = 5;

    // เติม padding ด้วยเลข 0 ให้ค่า Auto Increment
    $paddedID = str_pad($autoIncrementValue, $desiredLength, '0', STR_PAD_LEFT);
    // echo  $paddedID;
    $sql = "INSERT INTO his (name, id, age, birth, weight) VALUES ('John Doe', :id, 30, '1993-05-15', 70.5)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $paddedID);
    $stmt->execute();

    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
} catch (PDOException $e) {
    echo "ผิดพลาด: " . $e->getMessage();
}

$pdo = null;
?>
