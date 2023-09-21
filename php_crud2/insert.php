<?php
include("database.php");
include("zsql_exe.php");

class InsertData
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // ปิด Auto Commit
    }

    public function insertRecord($data)
    {
        try {
            $this->conn->beginTransaction(); // เริ่ม Transaction
            $sql = "INSERT INTO his (name, id, age) VALUES (:name, :id, :age)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':age', $data['age']);

            $stmt->execute();
            
            $this->conn->commit(); // Commit การ Transaction
            //    if ($this->conn->inTransaction()) {
            //     $this->conn->commit(); // Commit การ Transaction ถ้ายังไม่เริ่ม Transaction จะไม่ทำอะไร
            // }
            // $this->conn->rollBack(); // Rollback การ Transaction เมื่อเกิดข้อผิดพลาด
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack(); // Rollback การ Transaction เมื่อเกิดข้อผิดพลาด
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $age = $_POST['age'];
    // ดำเนินการกับข้อมูลตามที่คุณต้องการ
    // เช่น บันทึกลงฐานข้อมูลหรือส่งอีเมล
    // ใช้คลาส InsertData เพื่อ insert ข้อมูล

    $insertData = new InsertData();
    $data = array(
        'name' => $name,
        'id' => $id ,
        'age' =>  $age,
    );

    // $this->conn->commit(); 
    if ($insertData->insertRecord($data)) {
        $response = array('message' => 'Data received successfully');
    } else {
        $response = array('error' => 'Data received Error');
    }

    // ส่งการตอบกลับ
    // $response = array('message' => 'Data received successfully');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

