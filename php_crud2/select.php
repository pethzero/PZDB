<?php
include("database.php");
include("zsql_exe.php");

class SelectData
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // ปิด Auto Commit
    }

    public function SelectRecord($data)
    {
        try {
            $this->conn->beginTransaction(); // เริ่ม Transaction
            // $sql = "SELECT * FROM his";
            $sql = sqlmixexe($data,null);
            $stmt = $this->conn->prepare($sql);

            // $stmt->bindParam(':name', $data['name']);
            // $stmt->bindParam(':id', $data['id']);
            // $stmt->bindParam(':age', $data['age']);

            $stmt->execute();
            
            $this->conn->commit(); // Commit การ Transaction
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // ส่งค่าผลลัพธ์กลับ
            return $result;
        } catch (PDOException $e) {
            $this->conn->rollBack(); // Rollback การ Transaction เมื่อเกิดข้อผิดพลาด
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

// ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $queryid = $_GET['queryid'];
    $selectData = new SelectData();
    $result = $selectData->SelectRecord( $queryid);

    if ($result !== false) {
        $response = array('status' => 'success', 'data' => $result);
    } else {
        $response = array('status' => 'error', 'message' => 'An error occurred');
    }

    // ส่งการตอบกลับในรูปแบบ JSON
    // echo $response;
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
