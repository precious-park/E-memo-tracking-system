<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $name = $_POST["name"]; 
    

    include('includes/dbh.php');
    
    $sql = "INSERT INTO departments (dept_name)
            VALUES ( '$name')";

    if ($conn->query($sql) === TRUE) {        
       
       
        echo "New record created successfully";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    
}




