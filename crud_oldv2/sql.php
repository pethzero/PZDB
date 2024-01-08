<?php
class SQLQueries
{
    private $sqlsreach = array();
    public function __construct()
    {
        // กำหนดคำสั่ง SQL สำหรับแต่ละค่า $queryIdHD ที่คุณต้องการ
        $this->sqlsreach['IND_APPPOINTMENT'] = "INSERT INTO appointment (CUSTNAME,DETAIL,REMARK,STARTD,WARND) VALUES (:name,:detail,:remark,:startd,:warmd)";
        $this->sqlsreach['UPD_APPPOINTMENT'] = " UPDATE appointment SET CUSTNAME = :name, DETAIL = :detail, REMARK = :remark, STARTD = :startd, WARND = :warmd WHERE RECNO = :recno";
        $this->sqlsreach['DLT_APPPOINTMENT'] = "  DELETE FROM appointment WHERE RECNO= :recno ";
        $this->sqlsreach['SELECT_APPPOINTMENT'] = "SELECT * FROM appointment ORDER BY RECNO DESC";
        $this->sqlsreach['001'] = "INSERT INTO appointment (CUSTNAME) VALUES (:name)";
        $this->sqlsreach['002'] = "INSERT INTO another_table (COLUMN_NAME) VALUES (:value)";
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
