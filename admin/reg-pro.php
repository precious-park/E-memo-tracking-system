<?php
include('includes/dbh.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];  
    $email = $_POST["email"];          
    $pwd = $_POST["password"];
    $role = $_POST["role"]; 

    
    
    $sql = "INSERT INTO users (first_name,last_name, email, password,roles)
            VALUES ( '$fname','$lname', '$email','$pwd','$role')";

    if ($conn->query($sql) === TRUE) {        
        $_SESSION['userID'] = $conn->insert_id;
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['role'] = $user['role'];
       
        header("Location:dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    header("location:register.php");
}




