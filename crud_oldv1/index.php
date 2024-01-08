<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Bootstrap 5 Table with Fetch API</title>
</head>
<body>

<div class="container mt-5">
  <h2>Employee List</h2>
  <form id="employeeForm">
    <label for="employeeName">Name:</label>
    <input type="text" id="employeeName" required>
    <button type="submit" class="btn btn-primary">Add Employee</button>
  </form>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="employeeTableBody">
      <!-- Employee data will be displayed here -->
    </tbody>
  </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Fetch data on page load
    fetchData();
    // Add event listener for the form submission
    document.getElementById('employeeForm').addEventListener('submit', function (event) {
      event.preventDefault();
      // Add your logic to handle adding employee
    });

    // Add event listener for the table rows
    document.getElementById('employeeTableBody').addEventListener('click', function (event) {
      const target = event.target;

      // Check if the clicked element is an edit, save, cancel, or delete button
      if (target.classList.contains('btn-edit')) {
        // Handle the edit button click
        handleEdit(target.closest('tr'));
      } else if (target.classList.contains('btn-save')) {
        // Handle the save button click
        handleSave(target.closest('tr'));
      } else if (target.classList.contains('btn-cancel')) {
        // Handle the cancel button click
        handleCancel(target.closest('tr'));
      } else if (target.classList.contains('btn-delete')) {
        // Handle the delete button click
        handleDelete(target.closest('tr'));
      }
    });
  });

  async function fetchData() {
    // Mock data for testing
    // const data = [
    //   { id: 1, name: 'John' },
    //   { id: 2, name: 'Jane' },
    // ];

    // Update the table with fetched data
    updateTable(data);
  }

  function updateTable(data) {
    const tableBody = document.getElementById('employeeTableBody');
    tableBody.innerHTML = '';

    data.forEach(employee => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${employee.id}</td>
        <td>
          <span class="name">${employee.name}</span>
          <input type="text" class="form-control edit-input" style="display: none;" value="${employee.name}">
        </td>
        <td>
          <button class="btn btn-primary btn-edit">Edit</button>
          <button class="btn btn-success btn-save" style="display: none;">Save</button>
          <button class="btn btn-warning btn-cancel" style="display: none;">Cancel</button>
          <button class="btn btn-danger btn-delete">Delete</button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  }

  function handleEdit(row) {
    const nameSpan = row.querySelector('.name');
    const nameInput = row.querySelector('.edit-input');

    nameSpan.style.display = 'none';
    nameInput.style.display = 'inline-block';

    row.querySelector('.btn-edit').style.display = 'none';
    row.querySelector('.btn-save').style.display = 'inline-block';
    row.querySelector('.btn-cancel').style.display = 'inline-block';
  }

  function handleSave(row) {
    const nameSpan = row.querySelector('.name');
    const nameInput = row.querySelector('.edit-input');

    // Implement logic to save the edited data
    // You may need to collect the edited data from the input field
    nameSpan.textContent = nameInput.value;

    nameSpan.style.display = 'inline-block';
    nameInput.style.display = 'none';

    row.querySelector('.btn-edit').style.display = 'inline-block';
    row.querySelector('.btn-save').style.display = 'none';
    row.querySelector('.btn-cancel').style.display = 'none';
  }

  function handleCancel(row) {
    const nameSpan = row.querySelector('.name');
    const nameInput = row.querySelector('.edit-input');

    nameSpan.style.display = 'inline-block';
    nameInput.style.display = 'none';

    row.querySelector('.btn-edit').style.display = 'inline-block';
    row.querySelector('.btn-save').style.display = 'none';
    row.querySelector('.btn-cancel').style.display = 'none';
  }

  function handleDelete(row) {
    // Implement logic to delete the row
    // You may prompt the user for confirmation before deleting
  }
</script>
</body>
</html>
