<?php
class DeleteData
{
    private $conn;
    public $data_commit;
    public $message_log;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // ปิด Auto Commit
        $this->data_commit = $this->conn;
    }

    public function deleteRecord($data, $sqlQuery, $condition)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->message_log = "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteRecordMultiple($dataArray, $sqlQuery, $condition)
    {
        try {
            foreach ($dataArray as $data) {
                $stmt = $this->conn->prepare($sqlQuery);
                bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            $this->message_log = "Error: " . $e->getMessage();
            return false;
        }
    }
}
