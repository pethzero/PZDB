<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Async/Await และ Promise ใน JavaScript</title>
</head>
<body>
  <h1>Async/Await และ Promise ใน JavaScript</h1>

  <!-- ตัวอย่างโค้ด Async/Await -->
  <h2>Async/Await</h2>
  <button id="fetchDataAsync">เรียกข้อมูล (Async/Await)</button>
  <div id="asyncResult"></div>

  <!-- ตัวอย่างโค้ด Promise -->
  <h2>Promise</h2>
  <button id="fetchDataPromise">เรียกข้อมูล (Promise)</button>
  <div id="promiseResult"></div>

  <script>
    // ตัวอย่างโค้ด Async/Await
    async function fetchDataAsync() {
      try {
        const response = await fetch('https://api.example.com/data');
        const data = await response.json();
        document.getElementById('asyncResult').textContent = JSON.stringify(data);
      } catch (error) {
        document.getElementById('asyncResult').textContent = 'เกิดข้อผิดพลาด: ' + error.message;
      }
    }

    document.getElementById('fetchDataAsync').addEventListener('click', fetchDataAsync);

    // ตัวอย่างโค้ด Promise
    function fetchDataPromise() {
      fetch('https://api.example.com/data')
        .then((response) => {
          if (!response.ok) {
            throw new Error('ไม่สามารถเรียกข้อมูลได้');
          }
          return response.json();
        })
        .then((data) => {
          document.getElementById('promiseResult').textContent = JSON.stringify(data);
        })
        .catch((error) => {
          document.getElementById('promiseResult').textContent = 'เกิดข้อผิดพลาด: ' + error.message;
        });
    }

    document.getElementById('fetchDataPromise').addEventListener('click', fetchDataPromise);
  </script>
</body>
</html>
