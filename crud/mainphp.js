document.addEventListener('DOMContentLoaded', function () {
    // Fetch data on page load
    fetchData();
  
    // Add event listener for the form submission
    document.getElementById('employeeForm').addEventListener('submit', function (event) {
      event.preventDefault();
      addEmployee();
    });
  });
  
  async function fetchData() {
    try {
      const response = await fetch('process_select.php'); // Replace with your API endpoint
      const data = await response.json();
      
      // console.log(data)
      // Update the table with fetched data
      updateTable(data);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }
  
  async function addEmployee() {
    const name = document.getElementById('employeeName').value;
  
    try {
      const response = await fetch('http://localhost:3000/employees', { // Replace with your API endpoint
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name }),
      });
  
      const data = await response.json();
  
      // Update the table with the new data
      updateTable(data);
  
      // Clear the input field
      document.getElementById('employeeName').value = '';
    } catch (error) {
      console.error('Error adding employee:', error);
    }
  }
  
  async function deleteEmployee(id) {
    try {
      const response = await fetch(`http://localhost:3000/employees/${id}`, { // Replace with your API endpoint
        method: 'DELETE',
      });
  
      const data = await response.json();
  
      // Update the table with the new data
      updateTable(data);
    } catch (error) {
      console.error('Error deleting employee:', error);
    }
  }
  
  function updateTable(data) {
    const tableBody = document.getElementById('employeeTableBody');
    tableBody.innerHTML = '';
  
    data.forEach(employee => {
      const row = `<tr>
                    <td>${employee.id}</td>
                    <td>${employee.name}</td>
                    <td>
                      <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${employee.id})">Delete</button>
                    </td>
                  </tr>`;
      tableBody.innerHTML += row;
    });
  }
  