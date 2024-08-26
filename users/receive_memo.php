<?php
session_start();
include_once 'includes/dbh.php';

// Assuming the department ID is stored in the session
$dept_id = $_SESSION['user']['dept_id'];
// $status = 'pending';
// Get data from AJAX request
$memo_id = $_POST['memo_id'];
$user_email = $_POST['user_email'];
$status = $_POST['status'];
$date_received = $_POST['date_received'];

// Insert data into recipients table
$sql = "INSERT INTO receipients (memo_id,user_email, status, date_received) 
        VALUES ('$memo_id', '$user_email', '$status', '$date_received')";

if ($conn->query($sql) === TRUE) {
    echo "Memo received successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

