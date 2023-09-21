<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Excel with PHPSpreadsheet</title>
</head>
<body>
    <button id="generateExcel">สร้าง Excel</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#generateExcel").click(function() {
                // ส่งข้อมูลไปยัง PHP สร้าง Excel
                $.ajax({
                    type: "POST",
                    url: "generate_excel.php",
                    data: {
                        data: [[1, 2, 3], [4, 5, 6]]
                    },
                    success: function(response) {
                        // เมื่อสร้าง Excel เสร็จสิ้น
                        // ดาวน์โหลดไฟล์ Excel จากการสร้าง
                        window.location.href = "download_excel.php?filename=" + response;
                    }
                });
            });
        });
    </script>
</body>
</html>
