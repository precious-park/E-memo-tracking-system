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
            Welcome, Admin
            <?php echo $_SESSION['user']['first_name']; ?>

          </h2>
        </div>

        <!-- Manage Users Section -->
        <section id="usersSection" class="mb-8">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Manage Users</h2>
            <!-- Add User Button -->
            <button class="mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" onclick="addUser()">
              + Add User
            </button>

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
                  <?php if ($userResult->num_rows > 0): ?>
                    <?php while ($user = $userResult->fetch_assoc()): ?>
                      <tr class="border-b">
                        <td class="px-4 py-2"><?php echo $user['user_id']; ?></td>
                        <td class="px-4 py-2"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                        <td class="px-4 py-2"><?php echo $user['email']; ?></td>
                        <td class="px-4 py-2"><?php echo $user['dept_id']; ?></td>
                        <td class="px-4 py-2"><?php echo $user['roles']; ?></td>
                        <td class="px-4 py-2 text-center">
                          <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded" onclick="editUser(<?php echo $user['user_id']; ?>)">Edit</button>
                          <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded" onclick="deleteUser(<?php echo $user['user_id']; ?>)">Delete</button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6" class="px-4 py-2 text-center">No users found.</td>
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
      $('#usersTable').DataTable();


      $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('hidden');
      });
    });

    function editUser(userId) {
      // Fetch user details with AJAX
      $.ajax({
        url: 'get_user.php',
        type: 'GET',
        dataType: 'json', // Add this to automatically parse JSON
        data: {
          user_id: userId
        },
        success: function(user) { // No need for JSON.parse() now
          // Fetch departments for dropdown
          $.ajax({
            url: 'get_dept.php',
            type: 'GET',
            dataType: 'json', // Add this to automatically parse JSON
            success: function(departments) { // No need for JSON.parse() now
              let deptOptions = departments.map(d =>
                `<option value="${d.dept_id}" ${d.dept_id == user.dept_id ? 'selected' : ''}>${d.dept_name}</option>`
              ).join("");

              Swal.fire({
                title: 'Edit User',
                html: `
              <input type="text" id="firstName" class="swal2-input" value="${user.first_name}" placeholder="First Name">
              <input type="text" id="lastName" class="swal2-input" value="${user.last_name}" placeholder="Last Name">
              <input type="email" id="email" class="swal2-input" value="${user.email}" placeholder="Email">
              <select id="deptId" class="swal2-input">
                ${deptOptions}
              </select>
              <select id="role" class="swal2-input">
                <option value="admin" ${user.roles === "admin" ? "selected" : ""}>Admin</option>
                <option value="staff" ${user.roles === "staff" ? "selected" : ""}>Staff</option>
              </select>
            `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                  const firstName = document.getElementById('firstName').value.trim();
                  const lastName = document.getElementById('lastName').value.trim();
                  const email = document.getElementById('email').value.trim();
                  const deptId = document.getElementById('deptId').value;
                  const role = document.getElementById('role').value;

                  if (!firstName || !lastName || !email || !deptId || !role) {
                    Swal.showValidationMessage('All fields are required');
                    return false;
                  }
                  return {
                    firstName,
                    lastName,
                    email,
                    deptId,
                    role
                  };
                }
              }).then((result) => {
                if (result.isConfirmed && result.value) {
                  $.ajax({
                    url: 'update_user.php',
                    type: 'POST',
                    // Remove dataType to let jQuery detect response type automatically
                    data: {
                      user_id: userId,
                      ...result.value
                    },
                    success: function(resp) {
                      // Handle both JSON and text responses
                      try {
                        // Try to parse if it's JSON
                        const jsonResponse = typeof resp === 'string' ? JSON.parse(resp) : resp;
                        if (jsonResponse.success) {
                          Swal.fire('Updated!', 'User has been updated.', 'success').then(() => {
                            location.reload();
                          });
                        } else {
                          Swal.fire('Error!', jsonResponse.message || 'Update failed', 'error');
                        }
                      } catch (e) {
                        // If it's not JSON, check for text response
                        if (resp.trim() === "success") {
                          Swal.fire('Updated!', 'User has been updated.', 'success').then(() => {
                            location.reload();
                          });
                        } else {
                          Swal.fire('Error!', resp, 'error');
                        }
                      }
                    },
                    error: function(xhr, status, error) {
                      console.error("AJAX Error:", error, "Status:", status);
                      console.log("Server response:", xhr.responseText);
                      Swal.fire('Error!', 'Something went wrong while updating.', 'error');
                    }
                  });
                }
              });
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error:", error, "Status:", status);
              console.log("Server response:", xhr.responseText);
              Swal.fire('Error!', 'Unable to fetch departments.', 'error');
            }
          });
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", error, "Status:", status);
          console.log("Server response:", xhr.responseText);
          Swal.fire('Error!', 'Unable to fetch user details.', 'error');
        }
      });
    }

    function addUser() {
      // Fetch departments dynamically for the select dropdown
      $.ajax({
        url: 'get_dept.php',
        type: 'GET',
        dataType: 'json',
        success: function(departments) {
          let deptOptions = departments.map(d => `<option value="${d.dept_id}">${d.dept_name}</option>`).join("");

          Swal.fire({
            title: 'Add New User',
            html: `
          <input type="text" id="firstName" class="swal2-input" placeholder="First Name">
          <input type="text" id="lastName" class="swal2-input" placeholder="Last Name">
          <input type="email" id="email" class="swal2-input" placeholder="Email">
          <input type="password" id="password" class="swal2-input" placeholder="Password">
          <select id="deptId" class="swal2-input">
            <option value="">Select Department</option>
            ${deptOptions}
          </select>
          <select id="role" class="swal2-input">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
          </select>
        `,
            showCancelButton: true,
            confirmButtonText: 'Add',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
              const firstName = document.getElementById('firstName').value.trim();
              const lastName = document.getElementById('lastName').value.trim();
              const email = document.getElementById('email').value.trim();
              const password = document.getElementById('password').value.trim();
              const deptId = document.getElementById('deptId').value;
              const role = document.getElementById('role').value;

              if (!firstName || !lastName || !email || !password || !deptId || !role) {
                Swal.showValidationMessage('All fields are required');
                return false;
              }

              return {
                firstName,
                lastName,
                email,
                password,
                deptId,
                role
              };
            }
          }).then((result) => {
            if (result.isConfirmed && result.value) {
              // Send the form data to the server
              $.ajax({
                url: 'add_user.php',
                type: 'POST',
                // Remove dataType: 'json' to let jQuery detect the response type automatically
                data: result.value,
                success: function(response) {
                  // Try to parse if it's JSON, otherwise handle as text
                  try {
                    const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                    if (jsonResponse.success) {
                      Swal.fire('Success!', 'User added successfully.', 'success');
                    } else {
                      Swal.fire('Error!', jsonResponse.message || 'Failed to add user.', 'error');
                    }
                  } catch (e) {
                    // If it's not JSON, check if it contains success message
                    if (response.includes('success') || response.includes('Success')) {
                      Swal.fire('Success!', 'User added successfully.', 'success');
                    } else {
                      Swal.fire('Error!', 'Unexpected response from server: ' + response, 'error');
                    }
                  }
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Error:", error, "Status:", status);
                  console.log("Server response:", xhr.responseText);
                  Swal.fire('Error!', 'Failed to add user. Please try again.', 'error');
                }
              });
            }
          });
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", error, "Status:", status);
          console.log("Server response:", xhr.responseText);
          Swal.fire('Error!', 'Unable to fetch departments.', 'error');
        }
      });
    }


    function deleteUser(userId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: {
              user_id: userId
            },
            success: function(response) {
              if (response.trim() === "success") {
                Swal.fire('Deleted!', 'User has been deleted.', 'success').then(() => {
                  location.reload();
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
  </script>

</body>

</html>