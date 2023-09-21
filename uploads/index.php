<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h2>Upload a File</h2>
    <form id="uploadForm" enctype="multipart/form-data">
      <!-- ... (your existing HTML code) ... -->
      <div class="mb-3">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>

      <div class="mb-3">
        <label for="id">ID:</label>
        <input type="text" class="form-control" id="id" name="id">
      </div>

      <div class="mb-3">
        <label for="age">Age:</label>
        <input type="text" class="form-control" id="age" name="age">
      </div>

      <div class="mb-3">
        <label for="birth">Birth:</label>
        <input type="text" class="form-control" id="birth" name="birth">
      </div>

      <div class="mb-3">
        <label for="weight">Weight:</label>
        <input type="text" class="form-control" id="weight" name="weight">
      </div>

      <div class="mb-3">
        <label for="height">Height:</label>
        <input type="text" class="form-control" id="height" name="height">
      </div>

      <!-- ... (your existing HTML code) ... -->


      <div class="mb-3">
        <table id="data-table" class="table">
          <tr>
            <th>Month</th>
            <th>Savings</th>
          </tr>
          <tr>
            <td>January</td>
            <td>$100</td>
          </tr>
          <tr>
            <td>February</td>
            <td>$80</td>
          </tr>
        </table>
      </div>

      <div class="mb-3">
        <input type="file" class="form-control" id="fileToUpload">
      </div>

      <div class="mb-3">
        <label for="fileToUpload">Select files to upload:</label>
        <input type="file" class="form-control" id="mutiplefileToUpload" name="mutiplefileToUpload[]" multiple>
      </div>

      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <div id="uploadStatus" class="mt-3"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#uploadForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('name', $('#name').val());

        // ดึงข้อมูลจากตาราง HTML
        var tableData = [];
        $('#data-table tr:not(:first-child)').each(function() {
          var rowData = {};
          rowData.month = $(this).find('td:nth-child(1)').text();
          rowData.savings = $(this).find('td:nth-child(2)').text();
          tableData.push(rowData);
        });

        // เพิ่มข้อมูลตารางลงใน formData
        formData.append('tableData', JSON.stringify(tableData));

        // อัพโหลดไฟล์และข้อมูลไปยังสคริปต์ PHP
        // formData.append('fileToUpload', $('#fileToUpload')[0].files[0]);
        var selectedFile = $('#fileToUpload')[0].files[0];
        if (selectedFile) {
          formData.append('fileToUpload', selectedFile);
          console.log($('#fileToUpload')[0].files[0]);
        } else {
          console.log('No file selected.');
        }

        // อัพโหลดไฟล์มากกว่าหนึ่งและข้อมูลไปยังสคริปต์ PHP
        var mutiplefiles = $('#mutiplefileToUpload')[0].files;
        if (mutiplefiles) {
          for (var i = 0; i < mutiplefiles.length; i++) {
            formData.append('mutiplefileToUpload[]', mutiplefiles[i]);
          }
          console.log(mutiplefiles);
        } else {
          console.log('No mutiple files selected.');
        }

        var paramhd = {
          RECNO: 'xx'
        };
        // เพิ่มอาร์เรย์ paramhd เข้าไปใน FormData และแปลงเป็น JSON ก่อน
        formData.append('paramhd', JSON.stringify(paramhd));



        $.ajax({
          url: 'upload.php',
          type: 'POST',
          data: formData,
          dataSrc: '',
          contentType: false,
          processData: false,
          success: function(response) {
            $('#uploadStatus').html(response);
          }
        });
      });
    });
  </script>
</body>

</html>