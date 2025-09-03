<?php
include('includes/dbh.php');

if(isset($_POST['dept_name'])){
    $deptName = mysqli_real_escape_string($conn, $_POST['dept_name']);

    $sql = "INSERT INTO departments (dept_name) VALUES ('$deptName')";
    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
?>
