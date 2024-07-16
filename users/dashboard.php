<?php
include('includes/dbh.php');
session_start();
// if (!isset($_SESSION['userID'])) {
//   header('Location: login.php');  // Redirect to login page if not authenticated
//   exit;
// }

// $userID = $_SESSION['userID'];


// // Query the database to get user data
// $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
// $stmt->bind_param("i", $userID);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows == 1) {
//     // User found
//     $user = $result->fetch_assoc();

    
// } else {
//     echo "User not found.";
// }

// $stmt->close();
// $conn->close();




?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php
    include('includes/header.php');
    include('includes/sidebar.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="text-light m-0">User Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Memo</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <h4 class="text-center ">Search Filter</h4>
            <form action="enhanced-results.html">
              <div class="row card">
                <div class="col-md-10 offset-md-1">
                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="" id="">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label>Department</label>
                        <select class="select2" style="width: 100%;">
                          <option>E-services</option>
                          <option>Audit</option>
                          <option>Procurement</option>
                          <option>P/S</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label>Author</label>
                        <select class="select2" style="width: 100%;">
                          <option>Precious</option>
                          <option>Maria</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class=" d-flex flex-row">
                    <div class="d-flex flex-row mb-4">
                      <div class="col-4">
                        <button type="submit" class="btn btn-warning ">Filter</button>
                      </div>
                    </div>
                    <div class="d-flex flex-row mb-4">
                      <div class="col-4">
                        <button type="submit" class="btn btn-warning ">Reset</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </section>
      </div>


      <!-- /.content-wrapper -->
      <!-- table to view the memos -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">View Memos</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>MEMO ID</th>
                        <th>SUBJECT</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th>DEPT.</th>
                        <th>FROM</th>
                        <th>TO</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       
                      </tr>
                      <tr>
                        
                      </tr>
                      <tr>
                        
                      </tr>
                      <tr>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>

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

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>