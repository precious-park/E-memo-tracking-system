<?php 
session_start();

include('includes/dbh.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    if (empty($email) || empty($pwd)) {
        echo "Email and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND roles = 'admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            $_SESSION['user'] = $user; 
            header('location:dashboard.php');
            exit();
            }
        else {
            echo "Invalid credentials.";
        }

        $stmt->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="card">
    <div class="card-body login-card-body" style="background-color: #005592" style="padding-block: 5rem">

      <section style="background-color: #005592">
        <div class="container-fluid">
          <div class="d-flex justify-content-center align-items-center">
            <div class="mw-100">
              <div class="card" style="border-radius: 1rem">
              <div class="d-flex  justify-content-center align-items-center">
                  <img src="images/coa2.png" alt="coa" width="100" height="100" />
                </div>
                <div class="d-flex  justify-content-center align-items-center">
                  <small class="text-black">Ministry Of ICT & National Guidance</small>
                </div>
                <div class="g-0">
                  
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">

                    <div class="card-body p-4 p-lg-5 text-black">

                      <form action="login.php" method="POST">
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #005592"></i>
                          <span class="h1 fw-bold mb-0">EMTS</span>
                        </div>
                        <span class="h4 fw mb-0 d-flex align-items-center mb-3 pb-1">Admin Login</span>

                        <div data-mdb-input-init class="form-outline mb-1">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />

                        </div>

                        <div data-mdb-input-init class="form-outline mb-1">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" required />

                        </div>


                        <div class="pt-1 mb-4">
                          <div class="col-7">
                            <button type="submit" class="btn btn-warning  btn-block">Login</button>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>


  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>