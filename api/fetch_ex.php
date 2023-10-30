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

    // สร้างคำขอ GET โดยใช้ Fetch API
    fetch(apiUrl)
        .then((response) => {
            // ตรวจสอบสถานะของคำขอ
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // แปลงข้อมูล JSON เป็น JavaScript object
            return response.json();
        })
        .then((data) => {
            // ใช้ข้อมูลที่ได้มา
            console.log(data);
            const apiDataElement = document.getElementById('apiData');

            // วนลูปผ่านข้อมูลและสร้าง HTML elements
            data.forEach((post) => {
                // const cardDiv = document.createElement('div');
                // cardDiv.classList.add('col-md-4', 'mb-3');

                // const card = document.createElement('div');
                // card.classList.add('card');

                // const cardBody = document.createElement('div');
                // cardBody.classList.add('card-body');

                // const cardTitle = document.createElement('h5');
                // cardTitle.classList.add('card-title');
                // cardTitle.textContent = post.title;

                // const cardText = document.createElement('p');
                // cardText.classList.add('card-text');
                // cardText.textContent = post.body;

                // cardBody.appendChild(cardTitle);
                // cardBody.appendChild(cardText);
                // card.appendChild(cardBody);
                // cardDiv.appendChild(card);

                // apiDataElement.appendChild(cardDiv);
                apiDataElement.innerHTML +=`
                     <div class="col-md-4 mb-3">
                         <div class="card">
                             <div class="card-body">
                                 <h5 class="card-title">${post.title}</h5>
                                 <p class="card-text">${post.body}</p>
                             </div>
                         </div>
                     </div>
                 `;
            });
        })
        .catch((error) => {
            // จัดการข้อผิดพลาด
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล API:', error);
        });
</script>