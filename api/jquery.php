<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดึงข้อมูล API ด้วย Fetch API และ jQuery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>ข้อมูลจาก API</h1>
        <div class="row" id="apiData">
            <!-- ข้อมูลจาก API จะถูกแสดงที่นี่ -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>


<script>
    $(document).ready(function () {
    // URL ของ API ที่ต้องการดึงข้อมูล
    const apiUrl = 'https://jsonplaceholder.typicode.com/posts';

    // ใช้ Fetch API ในการดึงข้อมูล
    fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
            // วนลูปผ่านข้อมูลและแสดงที่ #apiData
            data.forEach((post) => {
                $('#apiData').append(`
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${post.body}</p>
                            </div>
                        </div>
                    </div>
                `);
            });
        })
        .catch((error) => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล API:', error);
        });
});
</script>