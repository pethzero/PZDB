<?php
// // สร้างอาร์เรย์ที่เก็บคำสั่ง SQL แยกตาม $queryIdHD
// $sqlsreach = array();

// // กำหนดคำสั่ง SQL สำหรับแต่ละค่า $queryIdHD ที่คุณต้องการ
// $sqlsreach['001'] = "INSERT INTO appointment (CUSTNAME) VALUES (:name)";


// function ScanSQL($queryId)
// {
//     global $sqlsreach;
//     if (array_key_exists($queryId, $sqlsreach)) {
//         $sqlQuery = $sqlsreach[$queryId];
//         return $sqlQuery;
//     } else {
//         return null;
//     }
// }


class SQLQueries {
    private $sqlsreach = array();

    public function __construct() {
        // กำหนดคำสั่ง SQL สำหรับแต่ละค่า $queryIdHD ที่คุณต้องการ
        $this->sqlsreach['IND_TEST'] = "INSERT INTO test (NAME) VALUES (:name)";
    }


    public function scanSQL($queryId) {
        if (array_key_exists($queryId, $this->sqlsreach)) {
            return $this->sqlsreach[$queryId];
        } else {
            return null;
        }
    }
}

