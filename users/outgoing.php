<?php
include('includes/dbh.php');
session_start();

// Get current department
$current_dept = $_SESSION['user']['dept_id'];
// Fetch departments excluding the current department
$sql = "SELECT * FROM departments WHERE dept_id != '$current_dept'";
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">
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
            <h1 class="text-light m-0">Welcome, Secretary <?php echo $_SESSION['user']['last_name'];
                                                            ?> <?php
                                                                echo $_SESSION['user']['dept_id']; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Outgoing</li>
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
              <h3 class="card-title">Register Outgoing Memo</h3>
              <div class="card-body">

                <div class="card-header flex-row d-flex">
                  <form action="add_file.php" method="post">
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
                      <label class="form-label" for="form2Example17">To department</label>
                      <select id="dept" name="dept" class="form-control form-control-lg">
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
                    <div class=" d-flex flex-row">
                      <div class="d-flex flex-row mb-4">
                        <div class="col-4">
                          <a href="dashboard.php"><button type="submit" class="btn btn-warning ">Send</button></a>
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
  <script src="../admin/dist/js/adminlte.min.js"></script>
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>