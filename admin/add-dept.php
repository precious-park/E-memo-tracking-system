<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php
    include('includes/header.php');
    // include('includes/sidebar.php');
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
              <a href="add-user.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Add User
                  <span class="right badge badge"></span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Departments
                  <span class="right badge badge"></span>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Admin Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Memo</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
        <div class="container pb-6">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Add Department</h3>
                <div class="card-header">
                  <form action="add-pro.php" method="post">
                  <div data-mdb-input-init class="form-outline mb-1">
                    <input type="name" name="name" id="form2Example17" class="form-control form-control-lg" required />
                    <label class="form-label">Dept. name</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                  </form>
                  
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Content Wrapper. Contains page content -->
    </div>

    





    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        MINISTRY OF ICT & NATIONAL GUIDANCE
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; EMTS</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>