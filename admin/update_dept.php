<?php
include('includes/dbh.php');

if(isset($_POST['dept_id']) && isset($_POST['dept_name'])){
    $deptId = intval($_POST['dept_id']);
    $deptName = mysqli_real_escape_string($conn, $_POST['dept_name']);

    $sql = "UPDATE departments SET dept_name = '$deptName' WHERE dept_id = $deptId";
    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

