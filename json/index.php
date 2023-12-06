<!doctype html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>

    </style>
</head>

<body>
    <form id="idForm" method="POST">
        <span class="input-group-text">ชื่อไฟล์</span>
        <input type="text" class="form-control" id="yourInputId" value="" maxlength="125" placeholder="ใส่ชื่อ">
        <button class="btn btn-success" id="save">save</button>
    </form>

</body>
<script>
    $(document).ready(function() {
        /////////////////////////////////////////////////////////////// INITOPEATION /////////////////////////////////////////////////////////
        $(window).keydown(function(event) {
            if (event.keyCode == 13 && !$(event.target).is('textarea')) {
                event.preventDefault();
                return false;
            }
        });

        // URL ที่ต้องการดึงข้อมูล JSON
        var jsonUrl = 'data.json';

        // ใช้ Fetch API เพื่อดึงข้อมูล JSON
        fetch(jsonUrl)
            .then(response => response.json())
            .then(data => {
                // แสดงข้อมูล JSON ใน console
                console.log('ข้อมูล JSON:', data);

                // นำข้อมูลไปแสดงใน input
                $('#yourInputId').val(data.datasetting);
            })
            .catch(error => console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error));


        // เมื่อมีการคลิกปุ่มบันทึก
        $('#save').on('click', function() {
            // ดึงค่าที่ต้องการบันทึกจาก input
            var newSettingValue = $('#yourInputId').val();
            console.log(newSettingValue)
            senddata(newSettingValue)
        });


        $('#idForm').on('submit', function(e) {
            e.preventDefault(); // ป้องกันการส่ง form ไปยังหน้าอื่น
            // ตรวจสอบว่าปุ่มที่ถูกคลิกคือ "save" หรือ "edit"
            let url = "";
            let status_sql = "";
            var clickedButtonName = e.originalEvent.submitter.name;
        });

        async function senddata(data) {
            var Param = [];
            var formData = new FormData();
            Param.push({
                datasetting: data
            })
            formData.append('Param', JSON.stringify(Param));
            try {
                // ดึงข้อมูล Excel จากเซิร์ฟเวอร์
                const jsonResponse = await fetch('edit.php', {
                    method: 'POST',
                    body: formData,
                });

                if (!jsonResponse.ok) {
                    $('.loading').hide();
                    throw new Error('Error sending data to server');
                }

                const jsonData = await jsonResponse.json();
                console.log(jsonData)
                $('.loading').hide();
            } catch (error) {
                console.error(error);
            }
        }

    });
</script>



</html>