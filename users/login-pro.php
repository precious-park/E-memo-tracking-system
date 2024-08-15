<?php

session_start(); 
include('includes/dbh.php');

// Check if form is submitted
if (isset($_POST['login'])) {
    // Get input values
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    if(!empty($email) && !empty($pwd)){
        // Prepare SQL query
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND roles = 'user'");
        
        // Check if prepare() failed
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters and execute query
        $stmt->bind_param("ss", $email, $pwd);
        if ($stmt->execute()) {
            // Get result set from the prepared statement
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, fetch user data and set session variables
                $user = $result->fetch_assoc(); 
                $_SESSION['user'] = $user;
                header('location:dashboard.php');
                exit();
            } else {
                echo "Invalid email or password";
            }
            
       } else {
           echo "Error executing the query: " . $conn->error;
       }

       // Close statement and database connection 
       $stmt->close();
       mysqli_close($conn);

   } else {
      echo "Email and password fields are required";
   }
}

   
