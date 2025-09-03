<?php
include('includes/dbh.php');

if(isset($_POST['dept_id'])){
    $deptId = intval($_POST['dept_id']);
    $sql = "DELETE FROM departments WHERE dept_id = $deptId";

    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

