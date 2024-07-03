<?php
session_start();

// Include database connection
include('includes/dbh.php'); // Adjust the path if necessary

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $pwd= $_POST['password'];

    // Prevent SQL Injection
    $username = stripslashes($name);
    $password = stripslashes($pwd);
    $username = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $pwd);

    // Query to check if the username and password match
    $sql = "SELECT id, password FROM users WHERE username='$name' AND password='$pwd'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $name;
        $_SESSION['userid'] = $row['id'];
        echo "Login successful! Welcome, " . $_SESSION['username'];
        header("location:dashboard.php");
} else {  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
} 
