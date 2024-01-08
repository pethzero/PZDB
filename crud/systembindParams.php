<?php
class bindParamData
{
    public static function bindParams($stmt, $data, $condition)
    {
        switch ($condition) {
            case '0001':
                $stmt->bindParam(':id', $data['id']);
                break;
            case '0002':
                $stmt->bindParam(':name', $data['name']);
                $stmt->bindParam(':score', $data['score']);
                $stmt->bindParam(':grade', $data['grade']);
                break;
            case '0003':
                $stmt->bindParam(':id', $data['id']);
                $stmt->bindParam(':name', $data['name']);
                $stmt->bindParam(':score', $data['score']);
                $stmt->bindParam(':grade', $data['grade']);
                break;
                // เพิ่มเงื่อนไขเพิ่มเติมตามความต้องการ
            default:
                // ไม่มีเงื่อนไขที่ตรงกัน
                break;
        }
    }
}

//        $stmt->bindParam(':id', ''); ห้ามว่าง