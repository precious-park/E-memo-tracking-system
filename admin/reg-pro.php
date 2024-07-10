<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $name = $_POST["name"]; 
    $email = $_POST["email"];          
    $pwd = $_POST["password"];

    include('includes/dbh.php');
    
    $sql = "INSERT INTO admin (username, email, password)
            VALUES ( '$name', '$email','$pwd')";

    if ($conn->query($sql) === TRUE) {        
       
       
        header("Location: admin/dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    header("location:register.php");
}




