<?php
include('includes/dbh.php');

if(isset($_GET['user_id'])){
    $userId = intval($_GET['user_id']);
    $sql = "SELECT user_id, first_name, last_name, email, dept_id, roles FROM users WHERE user_id = $userId";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "User not found"]);
    }
}

