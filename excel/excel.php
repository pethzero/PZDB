<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Excel Import</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Import Excel Data</h2>
    <form action="import.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="excelFile" class="form-label">Choose Excel File:</label>
        <input type="file" class="form-control" id="excelFile" name="excelFile" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Import</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
