<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... -->
</head>
<body>
  <div class="container mt-5">
    <h2>Upload a File</h2>
    <form id="uploadForm" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="additionalData">Additional Data:</label>
        <textarea class="form-control" id="additionalData" name="additionalData"></textarea>
      </div>
      <div class="mb-3">
        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required>
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
        formData.append('name', $('#name').val()); // Add the name input
        formData.append('additionalData', $('#additionalData').val()); // Add the additionalData textarea
        formData.append('fileToUpload', $('#fileToUpload')[0].files[0]);

        $.ajax({
          url: 'upload.php',
          type: 'POST',
          data: formData,
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
