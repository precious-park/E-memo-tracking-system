<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
                  <div class="flex-row">
                    <div class="pt-1 mb-4 flex-row">
                      <div class="col-4">
                        <button type="submit" class="btn btn-dark  btn-block">Filter</button>
                      </div>
                    </div>
                    <div class="mb-4 flex-row">
                      <div class="col-4">
                        <button type="submit" class="btn btn-dark  btn-block">Reset</button>
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
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>183</td>
                        <td>John Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>219</td>
                        <td>Alexander Pierce</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-warning">Pending</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>657</td>
                        <td>Bob Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-primary">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>175</td>
                        <td>Mike Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-danger">Denied</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
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
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>