<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Select2 + DataTables</title>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css">
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#TestTable').dataTable({
        pageLength: 5, 
        ordering: false, 
        drawCallback: function(dt) {
          console.log("draw() callback; initializing Select2's.");
          $('.experience-jquerySelect2-tag').select2({tags: true, width: "6em"});
        }
      });
    });
  </script>
</head>

<body>
  <table class="table-sm table-striped table-condensed" id="TestTable">
    <thead>
      <tr class="small">
        <th scope="col">Drop Down</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience1" name="experience" required>
              <option value="Test1">Test 1</option>
              <option value="Test2">Test 2</option>
              <option value="Test3">Test 3</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience2" name="experience" required>
              <option value="Test1">Test 2</option>
              <option value="Test2">Test 3</option>
              <option value="Test3">Test 4</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience3" name="experience" required>
              <option value="Test1">Test 3</option>
              <option value="Test2">Test 4</option>
              <option value="Test3">Test 5</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience4" name="experience" required>
              <option value="Test1">Test 4</option>
              <option value="Test2">Test 5</option>
              <option value="Test3">Test 6</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience5" name="experience" required>
              <option value="Test1">Test 5</option>
              <option value="Test2">Test 6</option>
              <option value="Test3">Test 7</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience6" name="experience" required>
              <option value="Test1">Test 6</option>
              <option value="Test2">Test 7</option>
              <option value="Test3">Test 8</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience7" name="experience" required>
              <option value="Test1">Test 7</option>
              <option value="Test2">Test 8</option>
              <option value="Test3">Test 9</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience8" name="experience" required>
              <option value="Test1">Test 8</option>
              <option value="Test2">Test 9</option>
              <option value="Test3">Test 10</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience9" name="experience" required>
              <option value="Test1">Test 9</option>
              <option value="Test2">Test 10</option>
              <option value="Test3">Test 11</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience10" name="experience" required>
              <option value="Test1">Test 10</option>
              <option value="Test2">Test 11</option>
              <option value="Test3">Test 12</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience11" name="experience" required>
              <option value="Test1">Test 11</option>
              <option value="Test2">Test 12</option>
              <option value="Test3">Test 13</option>
            </select>
          </span>
        </td>
      </tr>
      <tr>
        <td valign="middle" align="left" class="small text-nowrap">
          <span class="form-group">
            <select class="form-control experience-jquerySelect2-tag"
              id="IDexperience12" name="experience" required>
              <option value="Test1">Test 12</option>
              <option value="Test2">Test 13</option>
              <option value="Test3">Test 14</option>
            </select>
          </span>
        </td>
      </tr>
    </tbody>
  </table>

</html>