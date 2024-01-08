<?php
class SQLQueries
{
    private $sqlsreach = array();
    public function __construct()
    {
        // กำหนดคำสั่ง SQL สำหรับแต่ละค่า $queryId ที่คุณต้องการ
        $this->sqlsreach['0000'] = "SELECT * FROM student";
        $this->sqlsreach['0001'] = "SELECT * FROM student WHERE id = :id";
        $this->sqlsreach['0002'] = "INSERT INTO student (name,score,grade) VALUES (:name,:score,:grade)";
        $this->sqlsreach['0003'] = "UPDATE student SET  name = :name,score = :score,grade = :grade WHERE id =:id ";
        $this->sqlsreach['0004'] = "DELETE FROM student WHERE id= :id ";
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
