<?php
session_start();

include('includes/dbh.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input values
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT user_id, email, password,roles FROM users WHERE email = ? AND password = ? AND roles = 'admin'");
    // $stmt = $conn->prepare("SELECT roles FROM users WHERE email = ? AND password = ?");
    // Check if prepare() failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute query
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // User found
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;

        // $_SESSION['user'] = [
        //     'user_id' => $user['id'],
        //     'email' => $user['email'],
        //     'first_name' => $user['name']
        // ];   
       
            header('Location: dashboard.php');       
        
    } 

    $stmt->close();
    $conn->close();
}