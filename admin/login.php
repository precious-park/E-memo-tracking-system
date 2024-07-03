<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="card">
    <div class="card-body login-card-body" style="background-color: #005592" style="padding-block: 5rem">

      <section class="vh-100" style="background-color: #005592">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="images/coa3.png" alt="login form" class="img-fluid" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">

                    <div class="card-body p-4 p-lg-5 text-black">

                      <form action="login-pro.php" method="POST" novalidate>
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #005592"></i>
                          <span class="h1 fw-bold mb-0">EMTS</span>
                        </div>
                        <span class="h4 fw mb-0 d-flex align-items-center mb-3 pb-1">Admin Register</span>

                        <div data-mdb-input-init class="form-outline mb-1">
                          <input type="name" name="name" id="form2Example17" class="form-control form-control-lg" required />
                          <label class="form-label">Username</label>
                        </div>
                        

                        <div data-mdb-input-init class="form-outline mb-1">
                          <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />
                          <label class="form-label">Email address</label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-1">
                          <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" required />
                          <label class="form-label">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                          <div class="col-4">
                            <button type="submit" class="btn btn-dark  btn-block">Register</button>
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