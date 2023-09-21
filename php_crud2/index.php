<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Form Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bootstrap 5 Form Submission</h1>
        <form id="myForm" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id"   value="id" name="id" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age"  value="000" name="age" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('myForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            const formData = new FormData(this);

            fetch('insert.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // ทำอะไรกับข้อมูลที่ได้รับจากเซิร์ฟเวอร์
                console.log(data);
            })
            .catch(error => {
                // จัดการเมื่อเกิดข้อผิดพลาด
                console.error('Error:', error);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>
</html>
