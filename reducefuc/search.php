<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <form id="employeeForm">
            <div class="mb-3">
                <label for="code" class="form-label">Code:</label>
                <input type="text" class="form-control" id="code" name="code" readonly>
            </div>

            <div class="mb-3">
                <label for="namereal" class="form-label">Name (Real):</label>
                <input type="text" class="form-control" id="namereal" name="namereal" readonly>
            </div>

            <div class="mb-3">
                <label for="namenick" class="form-label">Name (Nickname):</label>
                <input type="text" class="form-control" id="namenick" name="namenick" readonly>
            </div>

            <div class="mb-3">
                <label for="login" class="form-label">Login:</label>
                <input type="text" class="form-control" id="login" name="login" readonly>
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="text" class="form-control" id="pass" name="pass" readonly>
            </div>

            <div class="mb-3">
                <label for="userlevel" class="form-label">User Level:</label>
                <input type="text" class="form-control" id="userlevel" name="userlevel" readonly>
            </div>

            <button type="button" class="btn btn-primary" onclick="search_datalist([{
      'EMPNO': 'E001',
      'EMPNAME': 'John Doe',
      'EMPNICK': 'Johnny',
      'LOGIN': 'john',
      'PASS': 'password',
      'USERLEVEL': 'F',
      'RECNO': 123
    }])">Fill Form</button>
        </form>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // แบบเก่า
        // function search_datalist(json_searchdatalist) {
        //   recno_edit = json_searchdatalist[0].RECNO
        //   $('#code').val(json_searchdatalist[0].EMPNO)
        //   $('#namereal').val(json_searchdatalist[0].EMPNAME)
        //   $('#namenick').val(json_searchdatalist[0].EMPNICK)
        //   $('#login').val(json_searchdatalist[0].LOGIN)
        //   $('#pass').val(json_searchdatalist[0].PASS)
        //   $('#userlevel').val(json_searchdatalist[0].USERLEVEL)
        // }

        function search_datalist(json_searchdatalist) {
            const fieldMappings = {
                code: 'EMPNO',
                namereal: 'EMPNAME',
                namenick: 'EMPNICK',
                login: 'LOGIN',
                pass: 'PASS',
                userlevel: 'USERLEVEL',
            };

            const data = json_searchdatalist[0];

            Object.entries(fieldMappings).forEach(([elementId, fieldName]) => {
                document.getElementById(elementId).value = data[fieldName];
            });
        }
    </script>

</body>

</html>