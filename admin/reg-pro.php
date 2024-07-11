<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];  
    $email = $_POST["email"];          
    $pwd = $_POST["password"];
    $role = $_POST["role"]; 

    include('includes/dbh.php');
    
    $sql = "INSERT INTO users (first_name,last_name, email, password,role)
            VALUES ( '$fname','$lname', '$email','$pwd','$role')";

    if ($conn->query($sql) === TRUE) {        
       
       
        header("Location:dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    header("location:register.php");
}




