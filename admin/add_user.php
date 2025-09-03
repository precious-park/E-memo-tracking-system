<?php
include('includes/dbh.php');

if(isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['deptId'], $_POST['role'])){
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hashing
    $deptId = intval($_POST['deptId']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "INSERT INTO users (first_name, last_name, email, password, dept_id, roles) 
            VALUES ('$firstName', '$lastName', '$email', '$password', $deptId, '$role')";

    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
?>
