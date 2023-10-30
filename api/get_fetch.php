<!DOCTYPE html>
<html>
<head>
    <title>Fetch API Example</title>
</head>
<body>
    <h1>Fetch API Example</h1>
    <button id="fetchButton">Fetch Data</button>
    <div id="output"></div>

    <script>
        // รับอ้างอิงไปยังปุ่มและส่วนที่จะแสดงผลลัพธ์
        const fetchButton = document.getElementById('fetchButton');
        const output = document.getElementById('output');

        // เมื่อคลิกปุ่ม "Fetch Data"
        fetchButton.addEventListener('click', () => {
            // ทำ HTTP GET request ไปยัง URL ที่ต้องการ
            fetch('https://apigw1.bot.or.th/bot/public/Stat-ExchangeRate/v2/DAILY_AVG_EXG_RATE/')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // แสดงข้อมูลที่ได้ใน <div> output
                    output.innerHTML = JSON.stringify(data, null, 2);
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    output.innerHTML = 'เกิดข้อผิดพลาดในการดึงข้อมูล';
                });
        });
    </script>
</body>
</html>
