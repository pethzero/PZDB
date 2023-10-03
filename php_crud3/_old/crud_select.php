<?php
class SelectData
{
    private $conn;
    public $data_commit;
    public $message_log;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        $this->message_log = $db->message_log;
        $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // ปิด Auto Commit
    }

    public function SelectRecord($sqlQuery)
    {
        try {
            $this->conn->beginTransaction(); // เริ่ม Transaction
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            $this->conn->commit(); // Commit การ Transaction
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // ส่งค่าผลลัพธ์กลับ
            // return $result;
            return array('result' => $result, 'status' => true,  'db_connect' => $this->message_log,'fecth_select' => 'select success');
        } catch (PDOException $e) {
            $this->conn->rollBack(); // Rollback การ Transaction เมื่อเกิดข้อผิดพลาด
            return array('result' => [],'status' => false, 'db_connect' => $this->message_log,'fecth_select' => $e->getMessage());
            // return false;
        }
    }
}

