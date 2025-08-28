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

// // Fetch users
// $sqlUsers = "SELECT id, first_name, last_name, email, dept_id, role FROM users";
// $userResult = $conn->query($sqlUsers);
//
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Panel - EMTS</title>
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
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
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
          <a href="#usersSection" class="flex items-center px-3 py-3 text-white">
            <span>Manage Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#departmentsSection" class="flex items-center px-3 py-3 text-white">
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

      <!-- Manage Users Section -->
      <section id="usersSection" class="mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Manage Users</h2>
          <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-4 py-2 text-left text-gray-600">ID</th>
                  <th class="px-4 py-2 text-left text-gray-600">Name</th>
                  <th class="px-4 py-2 text-left text-gray-600">Email</th>
                  <th class="px-4 py-2 text-left text-gray-600">Department</th>
                  <th class="px-4 py-2 text-left text-gray-600">Role</th>
                  <th class="px-4 py-2 text-center text-gray-600">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if($userResult->num_rows > 0): ?>
                  <?php while($user = $userResult->fetch_assoc()): ?>
                    <tr class="border-b">
                      <td class="px-4 py-2"><?php echo $user['id']; ?></td>
                      <td class="px-4 py-2"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                      <td class="px-4 py-2"><?php echo $user['email']; ?></td>
                      <td class="px-4 py-2"><?php echo $user['dept_id']; ?></td>
                      <td class="px-4 py-2"><?php echo $user['role']; ?></td>
                      <td class="px-4 py-2 text-center">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="6" class="px-4 py-2 text-center">No users found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Manage Departments Section -->
      <section id="departmentsSection">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Manage Departments</h2>
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
                <?php if($deptResult->num_rows > 0): ?>
                  <?php while($dept = $deptResult->fetch_assoc()): ?>
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
                  <tr><td colspan="3" class="px-4 py-2 text-center">No departments found.</td></tr>
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
    $('#usersTable').DataTable();
    $('#departmentsTable').DataTable();

    $('#sidebarToggle').click(function() {
      $('.sidebar').toggleClass('hidden');
    });
  });

  function editUser(userId){
    Swal.fire('Edit User', 'Function to edit user ID: ' + userId, 'info');
  }

  function deleteUser(userId){
    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete user ID: ' + userId + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Yes, delete!'
    }).then((result) => {
      if(result.isConfirmed){
        // Add AJAX delete request here
        Swal.fire('Deleted!', 'User has been deleted.', 'success');
      }
    });
  }

  function editDept(deptId){
    Swal.fire('Edit Department', 'Function to edit department ID: ' + deptId, 'info');
  }

  function deleteDept(deptId){
    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete department ID: ' + deptId + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Yes, delete!'
    }).then((result) => {
      if(result.isConfirmed){
        // Add AJAX delete request here
        Swal.fire('Deleted!', 'Department has been deleted.', 'success');
      }
    });
  }
</script>

</body>
</html>
