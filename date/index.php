<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap 5 and Flatpickr Example</title>
  <!-- เรียกใช้ Bootstrap 5 CSS ผ่าน CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- เรียกใช้ Flatpickr ผ่าน CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Bootstrap 5 and Flatpickr Example</h1>
    
    <!-- HTML Element สำหรับการเลือกวันที่และเวลา -->
    <input type="text" class="form-control" id="datepicker" placeholder="เลือกวันที่และเวลา">
  </div>

  <script>
    // สร้าง Flatpickr
    const datePicker = flatpickr("#datepicker", {
      enableTime: true, // เปิดใช้งานการเลือกเวลา
      dateFormat: "Y-m-d H:i", // รูปแบบวันที่และเวลาที่ต้องการ
    });
  </script>

  <!-- เรียกใช้ Bootstrap 5 JavaScript และ Popper.js ผ่าน CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
