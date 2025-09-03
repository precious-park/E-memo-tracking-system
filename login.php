<?php 
session_start();
include('dbh.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd   = $_POST['password'];

    if (empty($email) || empty($pwd)) {
        $error = "Email and password are required.";
    } else {
        // Select user by email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // ✅ Plain-text password check
            if ($pwd === $user['password']) {
                $_SESSION['user'] = $user;

                // ✅ Redirect based on role
                if ($user['roles'] === 'admin') {
                    header("Location: admin/dashboard.php"); // admin dashboard
                    exit();
                } elseif ($user['roles'] === 'user') {
                    header("Location: users/dashboard.php"); // user dashboard
                    exit();
                } else {
                    $error = "Role not recognized.";
                }
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with this email.";
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
  <title>E-Memo Tracking System | Login</title> 
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">
  <link href="src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-600 to-blue-800 min-h-screen flex items-center justify-center">

  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8">
    <div class="flex justify-center mb-4">
      <img src="images/coa2.png" alt="coa" class="w-24 h-24">
    </div>

    <h1 class="text-center text-2xl font-bold text-blue-700 mb-2">Ministry of ICT & National Guidance</h1>
    <h2 class="text-center text-lg text-gray-600 mb-6">E-Memo Tracking System</h2>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 p-2 mb-4 rounded-md text-center">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
        Login
      </button>
    </form>
  </div>

</body>
</html>
