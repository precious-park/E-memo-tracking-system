<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../plugins/datatables/jquery.dataTables.js">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include('includes/header.php');
        ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="images/coa.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">EMTS</span>

      </a>
      <div class="brand-link">
        <span class="brand-text font-weight-light">MINISTRY OF ICT & <br>
          NATIONAL GUIDANCE</span>
      </div>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="view.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  View Memos

                </p>
              </a>

            </li>
            <li class="nav-item menu">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Register Memo
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="income.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Incoming</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="outgoing.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Outgoing</p>
                  </a>

                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="memos.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Send Memo

                </p>
              </a>

            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="left fas fa-angle-left"></i>
                <p>
                  Log Out

                </p>
              </a>

            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">User Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">View Memo</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->

                <!-- /.content-header -->
                <!-- Content Wrapper. Contains page content -->
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">

                    </div>

                </div>
            </div>

            <table id="memosTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Memo ID</th>
                        <th>Subject</th>
                        <th>Author</th>
                        <th>To Department</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
            </table>

        </div>
        <script>
            $(document).ready(function() {
                $('#memosTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "table-pro.php", // Path to PHP script
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
                        }
                    ]
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <!-- <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

        <!-- <script src="plugins/jquery/jquery.min.js"></script>  -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="dist/js/adminlte.min.js"></script>
        <!-- <script src="plugins/select2/js/select2.full.min.js"></script> -->
        <script>
            $(function() {
                $('.select2').select2()
            });
        </script>

</body>

</html>