<?php
include('includes/dbh.php');

if(isset($_POST['user_id'])){
    $userId = intval($_POST['user_id']);
    $sql = "DELETE FROM users WHERE user_id = $userId";

    if($conn->query($sql) === TRUE){
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
