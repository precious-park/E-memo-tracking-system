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
  <script src="https://cdn.tailwindcss.com"></script>
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
            <a href="departments.php" class="flex items-center px-3 py-3 text-white">
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
        <p>Role: <span class="font-semibold"><?php echo $_SESSION['user']['roles']; ?></span></p>
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
            Welcome, Admin <?php echo $_SESSION['user']['first_name']; ?>
          </h2>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Users Card -->
          <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between">
            <div>
              <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
              <p class="text-3xl font-bold text-blue-700" id="totalUsers">0</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13-1.13a4 4 0 10-7 0 4 4 0 007 0zM9 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
          </div>

          <!-- Memos Card -->
          <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between">
            <div>
              <h3 class="text-lg font-semibold text-gray-700">Total Memos</h3>
              <p class="text-3xl font-bold text-green-700" id="totalMemos">0</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6M9 17h13M9 17H7a2 2 0 01-2-2V7h16v2M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
              </svg>
            </div>
          </div>

          <!-- Departments Card -->
          <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between">
            <div>
              <h3 class="text-lg font-semibold text-gray-700">Departments</h3>
              <p class="text-3xl font-bold text-purple-700" id="totalDepartments">0</p>
            </div>
            <div class="bg-purple-100 p-4 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
              </svg>
            </div>
          </div>
        </div>

      </main>

      <!-- FOOTER -->
      <footer class="bg-blue-700 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between text-sm">
          <span>&copy; <?php echo date('Y'); ?> EMTS - All Rights Reserved</span>
          <span>MINISTRY OF ICT & NATIONAL GUIDANCE</span>
        </div>
      </footer>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#usersTable').DataTable();
      $('#departmentsTable').DataTable();

      $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('hidden');
      });
    });

    function editUser(userId) {
      Swal.fire('Edit User', 'Function to edit user ID: ' + userId, 'info');
    }

    function deleteUser(userId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete user ID: ' + userId + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Add AJAX delete request here
          Swal.fire('Deleted!', 'User has been deleted.', 'success');
        }
      });
    }

    function editDept(deptId) {
      Swal.fire('Edit Department', 'Function to edit department ID: ' + deptId, 'info');
    }

    function deleteDept(deptId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete department ID: ' + deptId + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Add AJAX delete request here
          Swal.fire('Deleted!', 'Department has been deleted.', 'success');
        }
      });
    }

    // Load dashboard stats
    function loadStats() {
      $.ajax({
        url: 'get_stats.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          $('#totalUsers').text(data.total_users);
          $('#totalMemos').text(data.total_memos);
          $('#totalDepartments').text(data.total_departments);
        },
        error: function(xhr, status, error) {
          console.error("Error loading stats:", error);
          $('#totalUsers').text("ERR");
          $('#totalMemos').text("ERR");
          $('#totalDepartments').text("ERR");
        }
      });
    }

    $(document).ready(function() {
      loadStats();
    });
  </script>

</body>

</html>