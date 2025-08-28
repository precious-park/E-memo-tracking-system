<?php
include('includes/dbh.php');
session_start();

$sql = "SELECT dept_id, dept_name FROM departments";
$result = $conn->query($sql);

if (!isset($_SESSION['user'])) {
  header('Location: login.php');  // Redirect to login page if not authenticated
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .sidebar {
      width: 260px;
      transition: all 0.3s ease;
    }

    .main-content {
      margin-left: 260px;
      transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
      .sidebar {
        margin-left: -260px;
        position: absolute;
        z-index: 100;
        height: 100%;
      }

      .main-content {
        margin-left: 0;
      }

      .sidebar.active {
        margin-left: 0;
      }
    }

    .nav-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-item.active {
      background-color: rgba(255, 255, 255, 0.2);
      border-left: 4px solid white;

    }

    .sidebar {
      width: 260px;
      transition: all 0.3s ease;
      background-color: #343a40;
    }

    .main-content {
      margin-left: 260px;
      transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
      .sidebar {
        margin-left: -260px;
        position: absolute;
        z-index: 100;
        height: 100%;
      }

      .main-content {
        margin-left: 0;
      }

      .sidebar.active {
        margin-left: 0;
      }
    }

    .nav-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-item.active {
      background-color: rgba(255, 255, 255, 0.2);
      border-left: 4px solid white;
    }

    .submenu {
      display: none;
      background-color: #2c3136;
    }

    .submenu.active {
      display: block;
    }

    .has-submenu.active .fa-angle-left {
      transform: rotate(-90deg);
    }
  </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- Mobile Menu Button -->
  <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 bg-blue-700 text-white p-2 rounded-md shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>

  <div class="flex flex-1">
    <!-- SIDEBAR -->
    <!-- SIDEBAR -->
    <aside class="sidebar bg-blue-800 text-white fixed h-full overflow-y-auto">
      <!-- Brand Logo -->
      <div class="p-4 border-b border-blue-700 flex items-center">
        <img src="images/coa.jpg" class="h-10 w-10 rounded-full mr-3" alt="Logo" style="opacity: .8">
        <div>
          <span class="font-semibold text-sm">EMTS</span>
          <div class="text-xs text-blue-200 mt-1">
            MINISTRY OF ICT & <br>NATIONAL GUIDANCE
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-6">
        <ul class="space-y-1 p-2">
          <!-- Dashboard -->
          <li class="nav-item ">
            <a href="dashboard.php" class="flex items-center px-3 py-3 text-white">

              <span>Dashboard</span>
            </a>
          </li>

          <!-- View Memo (Treeview) -->
          <li class="nav-item has-submenu">
            <a href="#" class="flex items-center justify-between px-3 py-3 text-white submenu-toggle">
              <div class="flex items-center">
                <i class="fas fa-book mr-3 w-5 text-center"></i>
                <span>View Memo</span>
              </div>
              <i class="fas fa-angle-left transition-transform"></i>
            </a>
            <ul class="submenu pl-11">
              <li class="nav-item">
                <a href="incoming.php" class="flex items-center px-3 py-2 text-white">
                  <i class="far fa-circle mr-2 text-xs"></i>
                  <span>Incoming</span>
                </a>
              </li>
              <li class="nav-item ">
                <a href="view-outgoing.php" class="flex items-center px-3 py-2 text-white">
                  <i class="far fa-circle mr-2 text-xs"></i>
                  <span>Outgoing</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- Register Memo (Treeview) -->
          <li class="nav-item has-submenu">
            <a href="#" class="flex items-center justify-between px-3 py-3 text-white submenu-toggle">
              <div class="flex items-center">
                <i class="fas fa-edit mr-3 w-5 text-center"></i>
                <span>Register Memo</span>
              </div>
              <i class="fas fa-angle-left transition-transform"></i>
            </a>
            <ul class="submenu pl-11">
              <li class="nav-item">
                <a href="outgoing.php" class="flex items-center px-3 py-2 text-white">
                  <i class="far fa-circle mr-2 text-xs"></i>
                  <span>Outgoing Memo</span>
                </a>
              </li>
            </ul>

          </li>

          <!-- Audit Trail -->
          <li class="nav-item active">
            <a href="view_audit.php" class="flex items-center px-3 py-3 text-white">
              <i class="fas fa-history mr-3 w-5 text-center"></i>
              <span>Audit Trail</span>
            </a>
          </li>

          <!-- Logout -->
          <li class="nav-item">
            <a href="logout.php" class="flex items-center px-3 py-3 text-white">
              <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- User Info at Bottom -->
      <div class="absolute bottom-0 w-full p-4 bg-blue-900 text-blue-200 text-xs">
        <p>Logged in as: <span class="font-semibold"><?php echo $_SESSION['user']['first_name']; ?></span></p>
        <p>Department: <span class="font-semibold"><?php echo $_SESSION['user']['dept_id']; ?></span></p>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content flex-grow flex flex-col w-full">
      <!-- HEADER -->
      <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <h1 class="text-xl font-semibold">E-Memo Tracking System</h1>
          <nav>
            <ol class="flex space-x-2 text-sm">
              <li><a href="#" class="hover:underline">Home</a></li>
              <li>/</li>
              <li class="font-bold">Dashboard</li>
            </ol>
          </nav>
        </div>
      </header>

      <!-- CONTENT -->
      <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-6 py-8">
          <!-- Greeting -->
          <div class="bg-blue-600 text-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-bold">
              Welcome, Secretary
              <?php echo $_SESSION['user']['first_name']; ?>
              (Dept ID: <?php echo $_SESSION['user']['dept_id']; ?>)
            </h2>
          </div>

          <!-- Content Area -->
          <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Outgoing Memos Table -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">Outgoing Memos</h2>

              <div class="overflow-x-auto">
                <table id="memosTable" class="min-w-full border border-gray-200 rounded-lg">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="px-4 py-2 text-left text-gray-600">Memo ID</th>
                      <th class="px-4 py-2 text-left text-gray-600">Subject</th>
                      <th class="px-4 py-2 text-left text-gray-600">Author</th>
                      <th class="px-4 py-2 text-left text-gray-600">To Department</th>
                      <th class="px-4 py-2 text-left text-gray-600">Status</th>
                      <th class="px-4 py-2 text-left text-gray-600">Date</th>
                      <th class="px-4 py-2 text-center text-gray-600">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <!-- Audit Trail Modal -->
            <div id="auditTrailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
              <div class="bg-white rounded-lg w-11/12 md:w-2/3 lg:w-1/2 p-6 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg font-semibold text-gray-800">Audit Trail</h3>
                  <button onclick="closeAuditModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
                </div>
                <div class="overflow-x-auto">
                  <table id="auditTrailTable" class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                      <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Action Type</th>
                        <th class="px-4 py-2 text-left text-gray-600">Action Date</th>
                        <th class="px-4 py-2 text-left text-gray-600">User Email</th>
                      </tr>
                    </thead>
                    <tbody id="auditTrailBody">
                      <!-- Filled dynamically via JS -->
                    </tbody>
                  </table>
                </div>
              </div>
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

  <!-- Init DataTable -->
  <script>
    $(document).ready(function() {
      $('#example').DataTable();

      // Mobile sidebar toggle
      $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('active');
      });

      // Close sidebar when clicking outside on mobile
      $(document).click(function(e) {
        if ($(window).width() < 768) {
          if (!$(e.target).closest('.sidebar').length && !$(e.target).is('#sidebarToggle')) {
            $('.sidebar').removeClass('active');
          }
        }
      });
    });
  </script>
  <script>
    // Submenu toggle
    document.querySelectorAll('.submenu-toggle').forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const parent = this.closest('.has-submenu');
        const submenu = parent.querySelector('.submenu');

        parent.classList.toggle('active');
        submenu.classList.toggle('active');
      });
    });

    // Mobile sidebar toggle
    document.getElementById('sidebarToggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('active');
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Initialize Outgoing Memos DataTable
      $('#memosTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "outgoing-pro.php",
          "type": "POST"
        },
        "columns": [{
            "data": "memo_id"
          },
          {
            "data": "subject"
          },
          {
            "data": "Author"
          },
          {
            "data": "To_Department"
          },
          {
            "data": "Status"
          },
          {
            "data": "date_created"
          },
          {
            "data": null,
            "render": function(data, type, row) {
              return `<button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded" onclick="viewAuditLog(${row.memo_id})">
                      View Audit Log
                    </button>`;
            }
          }
        ]
      });
    });

    function viewAuditLog(memoId) {
      $.ajax({
        url: 'audit_trail.php',
        type: 'POST',
        data: {
          memo_id: memoId
        },
        success: function(response) {
          let auditLogData = JSON.parse(response);
          let tbodyHtml = '';

          auditLogData.forEach(log => {
            tbodyHtml += `
            <tr class="border-b">
              <td class="px-4 py-2">${log.action_type}</td>
              <td class="px-4 py-2">${log.action_date}</td>
              <td class="px-4 py-2">${log.user_email}</td>
            </tr>`;
          });

          document.getElementById('auditTrailBody').innerHTML = tbodyHtml;
          document.getElementById('auditTrailModal').classList.remove('hidden');
        },
        error: function(xhr, status, error) {
          console.error('Error fetching audit log:', error);
          alert('Failed to fetch audit trail.');
        }
      });
    }

    function closeAuditModal() {
      document.getElementById('auditTrailModal').classList.add('hidden');
    }
  </script>


</body>

</html>