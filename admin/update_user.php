<?php
include('includes/dbh.php');

if(isset($_POST['user_id'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['deptId'], $_POST['role'])){
    $userId = intval($_POST['user_id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $deptId = intval($_POST['deptId']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE users 
            SET first_name='$firstName', last_name='$lastName', email='$email', dept_id=$deptId, roles='$role' 
            WHERE user_id=$userId";

    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
