<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
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
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                View Memos
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Register Memo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="income.php" class="nav-link active">
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
                            <h1 class="m-0">User Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Incoming</li>
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
              <div class="card">
                <h3 class="card-title">Register Incoming Memo</h3>
                <div class="card-body">

                  <div class="card-header flex-row d-flex">
                    <form action="" method="post">
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" id="form2Example17" class="form-control form-control-lg" required />

                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" id="form2Example17" class="form-control form-control-lg" required />

                      </div>
                      
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" id="form2Example17" class="form-control form-control-lg" required />

                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">From Department</label>
                        <input type="text" name="dept" id="form2Example17" class="form-control form-control-lg" required />

                      </div>                       
                      <div class=" d-flex flex-row">
                    <div class="d-flex flex-row mb-4">
                      <div class="col-4">
                        <button type="submit" class="btn btn-warning ">Save</button>
                      </div>
                    </div>
                    <div class="d-flex flex-row mb-4">
                      <div class="col-4">
                        <button type="submit" class="btn btn-warning ">Clear</button>
                      </div>
                    </div>
                  </div>
                    </form>

                  </div>
                </div>

              </div>
            </div>

          </div>
        </div><!-- /.container-fluid -->
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
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