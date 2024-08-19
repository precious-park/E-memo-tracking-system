<?php
session_start();
include('includes/dbh.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    
    $subject = $_POST["subject"];
    $author = $_POST["author"];        
    $dept = $_POST["dept"]; 
    $date = $_POST["date"];    
    
    $sql = "INSERT INTO memos (subject,Author,To_Department,Status, date_created)
            VALUES ( '$subject','$author', '$dept','Pending','$date')";

    if ($conn->query($sql) === TRUE) {        
        $_SESSION['memo_id'] = $conn->insert_id;        
       
        header("Location:dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {   
    header("location:register.php");
}




