<?php
class bindParamData {
    public static function bindParams($stmt, $data, $condition) {
        switch ($condition) {
            case 'DT000':
                $stmt->bindParam(':recno', $data['recno']);
                break;
            case '001':
                $stmt->bindParam(':name', $data['name']);
                break;
            // เพิ่มเงื่อนไขเพิ่มเติมตามความต้องการ
            default:
                // ไม่มีเงื่อนไขที่ตรงกัน
                break;
        }
    }
}