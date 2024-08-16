<?php
include('includes/dbh.php');
include('user-pro.php');
// Check connectio

$sql = "SELECT dept_id, dept_name FROM departments";
$result = $conn->query($sql);


$conn->close();
?>



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
    include('includes/sidebar.php');
    // 
    ?>

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
                <li class="breadcrumb-item active">Add User</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <h3 class="card-title">Add User</h3>

                <div class="card-body">

                  <div class="card-header">
                    <form action="user-pro.php" method="post">
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">First name</label>
                        <input type="fname" name="fname" id="form2Example17" class="form-control form-control-lg" required />


                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Last name</label>
                        <input type="lname" name="lname" id="form2Example17" class="form-control form-control-lg" required />


                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />

                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="form2Example17" class="form-control form-control-lg" required />


                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label" for="form2Example17">Role</label>
                        <select id="role" name="role" class="form-control form-control-lg">
                          <option value="Admin">Admin</option>
                          <option value="User">User</option>
                        </select>

                      </div>
                      <div data-mdb-input-init class="form-outline mb-1">
                        <label class="form-label" for="form2Example17">Department</label>
                        <select id="department" name="department" class="form-control form-control-lg">
                          <?php
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              echo "<option value='" . $row["dept_id"] . "'>" . $row["dept_name"] . "</option>";
                            }
                          } else {
                            echo "<option value=''>No departments available</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="pt-1 mb-4">
                        <div class="col-4">
                          <button type="submit" class="btn btn-warning">Add</button>
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
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>