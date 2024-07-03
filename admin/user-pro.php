<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $name = $_POST["name"]; 
    $email = $_POST["email"];
    $type = $_POST["type"];          
    $pwd = $_POST["password"];
    $dname = $_POST["dname"];

    include('includes/dbh.php');
    
    $sql = "INSERT INTO users (username, email, access_type,password,dept_name)
            VALUES ( '$name', '$email','$type','$pwd','$dname')";

    if ($conn->query($sql) === TRUE) {        
       
       
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    header("location:index.php");
}




