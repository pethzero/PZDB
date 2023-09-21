<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดึงข้อมูล API ด้วย Fetch API และ jQuery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>ข้อมูลจาก API</h1>
        <div class="row" id="apiData">
            <!-- ข้อมูลจาก API จะถูกแสดงที่นี่ -->
        </div>
    </div>

</body>

</html>


<script>
 // URL ของ API ที่ต้องการดึงข้อมูล
const apiUrl = 'https://jsonplaceholder.typicode.com/posts';

// สร้าง XMLHttpRequest object
const xhr = new XMLHttpRequest();

// กำหนดว่าจะใช้ HTTP GET method และ URL ของ API
xhr.open('GET', apiUrl, true);

// กำหนด callback function สำหรับเมื่อข้อมูลถูกโหลดสำเร็จ
xhr.onload = function () {
    // ตรวจสอบสถานะของคำขอ
    if (xhr.status === 200) {
        // แปลงข้อมูล JSON เป็น JavaScript object
        const data = JSON.parse(xhr.responseText);
        const apiDataElement = document.getElementById('apiData');

        // วนลูปผ่านข้อมูลและสร้าง HTML elements
        data.forEach((post) => {
            const cardDiv = document.createElement('div');
            cardDiv.classList.add('col-md-4', 'mb-3');

            const card = document.createElement('div');
            card.classList.add('card');

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            const cardTitle = document.createElement('h5');
            cardTitle.classList.add('card-title');
            cardTitle.textContent = post.title;

            const cardText = document.createElement('p');
            cardText.classList.add('card-text');
            cardText.textContent = post.body;

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardText);
            card.appendChild(cardBody);
            cardDiv.appendChild(card);

            apiDataElement.appendChild(cardDiv);
        });
    } else {
        console.error('เกิดข้อผิดพลาดในการดึงข้อมูล API:', xhr.statusText);
    }
};

// กำหนด callback function สำหรับเมื่อเกิดข้อผิดพลาดในการดึงข้อมูล API
xhr.onerror = function () {
    console.error('เกิดข้อผิดพลาดในการดึงข้อมูล API');
};

// ส่งคำขอไปยัง API
xhr.send();

</script>