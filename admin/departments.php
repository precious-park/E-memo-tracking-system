<?php
session_start();
include('includes/dbh.php');


if (!isset($_SESSION['user'])) {
  header('Location: login.php');  // Redirect to login page if not authenticated
  exit;
}

// Fetch departments
$sql = "SELECT dept_id, dept_name FROM departments";
$deptResult = $conn->query($sql);

// Fetch users
$sqlUsers = "SELECT user_id, first_name, last_name, email, dept_id, roles FROM users";
$userResult = $conn->query($sqlUsers);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ministry of ICT & National Guidance E-Memo Tracking System | Admin Panel</title>
  <link rel="stylesheet" href="/src/output.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

  <!-- Mobile Menu Button -->
  <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 bg-blue-700 text-white p-2 rounded-md shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>

  <div class="flex flex-1">
    <!-- Sidebar -->
    <aside class="sidebar bg-blue-800 text-white fixed h-full overflow-y-auto w-64">
      <div class="p-4 border-b border-blue-700 flex items-center">
        <img src="images/coa.jpg" class="h-10 w-10 rounded-full mr-3" alt="Logo" style="opacity:.8">
        <div>
          <span class="font-semibold text-sm">EMTS</span>
          <div class="text-xs text-blue-200 mt-1">ADMIN PANEL</div>
        </div>
      </div>

      <nav class="mt-6">
        <ul class="space-y-1 p-2">
          <li class="nav-item">
            <a href="dashboard.php" class="flex items-center px-3 py-3 text-white">
              <span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="flex items-center px-3 py-3 text-white">
              <span>Manage Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="departments.ph" class="flex items-center px-3 py-3 text-white">
              <span>Manage Departments</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="flex items-center px-3 py-3 text-white">
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="absolute bottom-0 w-full p-4 bg-blue-900 text-blue-200 text-xs">
        <p>Logged in as: <span class="font-semibold"><?php echo $_SESSION['user']['first_name']; ?></span></p>
        <p>Role: <span class="font-semibold"><?php echo $_SESSION['user']['role']; ?></span></p>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content flex-grow flex flex-col w-full ml-64">
      <!-- Header -->
      <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <h1 class="text-xl font-semibold">Admin Panel</h1>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-grow px-6 py-8">

        <div class="bg-blue-600 text-white rounded-lg shadow-md p-6 mb-6">
          <h2 class="text-lg font-bold">
            Welcome, Admin
            <?php echo $_SESSION['user']['first_name']; ?>

          </h2>
        </div>

        <!-- Manage Departments Section -->
        <section id="departmentsSection">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Manage Departments</h2>
            <!-- Add Department Button -->
            <button class="mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" onclick="addDept()">
              + Add Department
            </button>
            <div class="overflow-x-auto">
              <table id="departmentsTable" class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                  <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Dept ID</th>
                    <th class="px-4 py-2 text-left text-gray-600">Dept Name</th>
                    <th class="px-4 py-2 text-center text-gray-600">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($deptResult->num_rows > 0): ?>
                    <?php while ($dept = $deptResult->fetch_assoc()): ?>
                      <tr class="border-b">
                        <td class="px-4 py-2"><?php echo $dept['dept_id']; ?></td>
                        <td class="px-4 py-2"><?php echo $dept['dept_name']; ?></td>
                        <td class="px-4 py-2 text-center">
                          <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded" onclick="editDept(<?php echo $dept['dept_id']; ?>)">Edit</button>
                          <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteDept(<?php echo $dept['dept_id']; ?>)">Delete</button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3" class="px-4 py-2 text-center">No departments found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

      </main>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      $('#departmentsTable').DataTable();

      $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('hidden');
      });
    });



    function editDept(deptId) {
      // First, fetch the department name using AJAX
      $.ajax({
        url: 'get_dept.php',
        type: 'GET',
        data: {
          dept_id: deptId
        },
        success: function(response) {
          const dept = JSON.parse(response);

          Swal.fire({
            title: 'Edit Department',
            html: `
          <input type="text" id="deptName" class="swal2-input" value="${dept.dept_name}" placeholder="Department Name">
        `,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
              const deptName = document.getElementById('deptName').value.trim();
              if (!deptName) {
                Swal.showValidationMessage('Please enter a department name');
              }
              return {
                deptName: deptName
              };
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const deptName = result.value.deptName;

              // 🚀 Update department via AJAX
              $.ajax({
                url: 'update_department.php',
                type: 'POST',
                data: {
                  dept_id: deptId,
                  dept_name: deptName
                },
                success: function(response) {
                  Swal.fire('Updated!', 'Department updated successfully!', 'success').then(() => {
                    location.reload(); // Refresh table
                  });
                },
                error: function() {
                  Swal.fire('Error!', 'Something went wrong while updating.', 'error');
                }
              });
            }
          });
        },
        error: function() {
          Swal.fire('Error!', 'Unable to fetch department details.', 'error');
        }
      });
    }


    function deleteDept(deptId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete department ID: ' + deptId + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          // 🚀 Send AJAX delete request
          $.ajax({
            url: 'delete_dept.php',
            type: 'POST',
            data: {
              dept_id: deptId
            },
            success: function(response) {
              if (response.trim() === "success") {
                Swal.fire('Deleted!', 'Department has been deleted.', 'success').then(() => {
                  location.reload(); // Refresh the table
                });
              } else {
                Swal.fire('Error!', response, 'error');
              }
            },
            error: function() {
              Swal.fire('Error!', 'Something went wrong with the request.', 'error');
            }
          });
        }
      });
    }

    function addDept() {
      Swal.fire({
        title: 'Add New Department',
        html: `
      <input type="text" id="deptName" class="swal2-input" placeholder="Department Name">
    `,
        showCancelButton: true,
        confirmButtonText: 'Add',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
          const deptName = document.getElementById('deptName').value.trim();
          if (!deptName) {
            Swal.showValidationMessage('Please enter a department name');
          }
          return {
            deptName: deptName
          };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const deptName = result.value.deptName;

          // 🚀 Example AJAX request (hook this to PHP)
          $.ajax({
            url: 'add_dept.php',
            type: 'POST',
            data: {
              dept_name: deptName
            },
            success: function(response) {
              Swal.fire('Success!', 'Department added successfully!', 'success').then(() => {
                location.reload(); // Reload to update table
              });
            },
            error: function() {
              Swal.fire('Error!', 'Something went wrong while adding.', 'error');
            }
          });
        }
      });
    }
  </script>

</body>

</html>