<?php
class CRUDDATA
{
    private $engine;
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;
    public $data_commit;
    public $message_log;

    /////////////////////////////////////////////////////////  __construct  //////////////////////////////////////////////////////////////
    // __construct คือเมื่อ class CRUDDATA เรียกใช้งาน จะถูกใช้เลย
    public function __construct($engine, $host, $db_name, $username, $password)
    {
        $this->engine =  $engine;
        $this->host =  $host;
        $this->db_name =  $db_name;
        $this->username =  $username;
        $this->password =  $password;

        $db = new Database($engine, $host, $db_name, $username, $password);
        $this->conn = $db->connect();
        $this->message_log = $db->message_log;
        $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // ปิด Auto Commit
        $this->data_commit = $this->conn;
    }
    /////////////////////////////////////////////////////////  SELECT  //////////////////////////////////////////////////////////////
    public function SelectRecord($sqlQuery)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array('result' => $result, 'status' => true,  'db_connect' => $this->message_log, 'message' => 'SelectData Successfully');
        } catch (PDOException $e) {
            return array('result' => [], 'status' => false, 'db_connect' => $this->message_log, 'message' => $e->getMessage());
        }
    }
    public function SelectRecordCondition($data, $sqlQuery, $condition)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array('result' => $result, 'status' => true,  'db_connect' => $this->message_log, 'message' => 'Select Data Successfully');
        } catch (PDOException $e) {
            return array('result' => [], 'status' => false, 'db_connect' => $this->message_log, 'message' => $e->getMessage());
        }
    }
    /////////////////////////////////////////////////////////  INSERT  //////////////////////////////////////////////////////////////
    public function insertRecord($data, $sqlQuery, $condition)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
            $stmt->execute();
            return array('result' => $data, 'status' => true,  'db_connect' => $this->message_log, 'message' => 'SelectData Successfully');
        } catch (PDOException $e) {
            return array('result' => [], 'status' => false, 'db_connect' => $this->message_log, 'message' => $e->getMessage());
        }
    }
    /////////////////////////////////////////////////////////  UPDATE  //////////////////////////////////////////////////////////////
    public function updateRecord($data, $sqlQuery, $condition)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
            $stmt->execute();
            return array('result' => $data, 'status' => true,  'db_connect' => $this->message_log, 'message' => 'Update Data Successfully');
        } catch (PDOException $e) {
            return array('result' => [], 'status' => false, 'db_connect' => $this->message_log, 'message' => $e->getMessage());
        }
    }
    /////////////////////////////////////////////////////////  DETELE  //////////////////////////////////////////////////////////////
    public function deleteRecord($data, $sqlQuery, $condition)
    {
        try {
            $stmt = $this->conn->prepare($sqlQuery);
            bindParamData::bindParams($stmt, $data, $condition); // เรียกใช้งาน bindParamData
            $stmt->execute();
            return array('result' => $data, 'status' => true,  'db_connect' => $this->message_log, 'message' => 'Delete Data Successfully');
        } catch (PDOException $e) {
            return array('result' => [], 'status' => false, 'db_connect' => $this->message_log, 'message' => $e->getMessage());
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
