<?php
class SQLQueries
{
    private $sqlsreach = array();
    public function __construct()
    {
        // กำหนดคำสั่ง SQL สำหรับแต่ละค่า $queryIdHD ที่คุณต้องการ
        $this->sqlsreach['SELECT_TEST'] = "SELECT * FROM employees ORDER BY ID DESC";
        $this->sqlsreach['INSERT_TEST'] = "INSERT INTO employees (NAME) VALUES (:name)";

    }
    public function scanSQL($queryId)
    {
        if (array_key_exists($queryId, $this->sqlsreach)) {
            return $this->sqlsreach[$queryId];
        } else {
            return null;
        }
    }
}
