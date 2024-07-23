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
    // $stmt = $conn->prepare("SELECT roles FROM users WHERE email = ? AND password = ?");
    // $query = mysqli_query($connection, $sql);
    // Check if prepare() failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute query
    $stmt->bind_param("ss", $email, $pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found
        $user = $result->fetch_assoc(); 
        // Set session variables
        $_SESSION['user'] = $user;
        
        header('location:dashboard.php');       
        
    } 

    $stmt->close();
    $conn->close();
}


   
}  
