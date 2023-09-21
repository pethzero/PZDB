<!DOCTYPE html>
<html>
<head>
    <title>Export to Excel</title>
    <!-- เรียกใช้ jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- ปุ่มสำหรับส่งข้อมูลไปยัง PHP -->
    <button id="exportButton">Export to Excel</button>

    <script>
        $(document).ready(function() {
            $("#exportButton").click(function() {
                // ข้อมูลที่ต้องการส่งไปยัง PHP
                var data = [
                    ['ROCKMAN', 2, 3],
                    [4, 5, 6],
                    ['GOT', 5, 6],
                    [4, 5, 6]
                ];

                // ส่งข้อมูลไปยัง PHP โดยใช้ AJAX
                $.ajax({
                    type: "POST",
                    url: "excel_export.php", // แก้ไขเป็น URL ของไฟล์ PHP ที่คุณสร้างขึ้น
                    data: { data: data ,
                    },
                    success: function(response) {
                        // data_json = JSON.parse(response).download;
                        // console.log(data_json)
                        // window.location.href = data_json;
                    }
                });
            });
        });
    </script>
</body>
</html>
