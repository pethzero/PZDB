<!DOCTYPE html>
<html>
<head>
    <title>Input ที่พิมพ์ได้และค้นหาผลลัพธ์แบบ select</title>
</head>
<body>
    <label for="searchInput">ค้นหา:</label>
    <input type="text" id="searchInput" oninput="filterOptions()" placeholder="พิมพ์เพื่อค้นหา">
    
    <label for="selectOptions">ผลลัพธ์:</label>
    <select id="selectOptions">
        <option value="">กรุณาเลือก</option>
        <option value="option1">ตัวเลือกที่ 1</option>
        <option value="option2">ตัวเลือกที่ 2</option>
        <option value="option3">ตัวเลือกที่ 3</option>
        <!-- เพิ่มตัวเลือกอื่น ๆ ตามต้องการ -->
    </select>

    <script>
        function filterOptions() {
            // รับข้อความที่ผู้ใช้ป้อนเข้ามา
            var inputText = document.getElementById("searchInput").value.toLowerCase();
            
            // ดึงตัวเลือกทั้งหมดใน select
            var select = document.getElementById("selectOptions");
            var options = select.getElementsByTagName("option");
            
            // กรองตัวเลือกตามข้อความที่ผู้ใช้ป้อน
            for (var i = 0; i < options.length; i++) {
                var optionText = options[i].text.toLowerCase();
                if (optionText.indexOf(inputText) !== -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
