<?php
include("database.php");

class UpdateData {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function updateRecord($data) {
        try {
            $sql = "UPDATE his SET name = :value1, id = :value2, age = :value3 WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':value1', $data['value1']);
            $stmt->bindParam(':value2', $data['value2']);
            $stmt->bindParam(':value3', $data['value3']);
            $stmt->bindParam(':id', $data['id']);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

// ใช้คลาส UpdateData เพื่ออัพเดทข้อมูล
$updateData = new UpdateData();
$data = array(
    'value1' => 'ค่าที่อัพเดท1',
    'value2' => 'ค่าที่อัพเดท2',
    'value3' => 'ค่าที่อัพเดท3',
    'id' => 1 // รหัสหรือเงื่อนไขที่ต้องการใช้ในการอัพเดท
);

if ($updateData->updateRecord($data)) {
    echo "อัพเดทข้อมูลสำเร็จ";
} else {
    echo "เกิดข้อผิดพลาดในการอัพเดทข้อมูล";
}
?>
