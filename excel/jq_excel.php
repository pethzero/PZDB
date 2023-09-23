<!DOCTYPE html>
<html>
<head>
    <title>Export to Excel</title>
    <!-- Include PhpSpreadsheet library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/phpeoffice/phpspreadsheet/1.17.0/PhpSpreadsheet.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Button to export data to Excel -->
    <button id="exportButton">Export to Excel</button>

    <script>
        $(document).ready(function() {
            $("#exportButton").click(function() {
                // Data to be sent to PHP
                var data = [
                    ['a', 'b', 'c'],
                    [1, 2, 3],
                    [4, 5, 6]
                ];

                // Create a FormData object and append data to it
                var formData = new FormData();
                formData.append('data', JSON.stringify(data));

                // Send data to the PHP script using Fetch API
                fetch('excel_export_test.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => {
                    if (response.ok) {
                        return response.blob(); // Get the Excel file as a blob
                    } else {
                        throw new Error('Error sending data to server');
                    }
                })
                .then((blob) => {
                    // Create a download link for the Excel file
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'exported_data.xlsx';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                })
                .catch((error) => {
                    console.error(error);
                });
           
           
           
           
           
            });
        });
    </script>
</body>
</html>
