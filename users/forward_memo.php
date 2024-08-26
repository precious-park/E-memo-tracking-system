<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include_once 'includes/dbh.php';
// $dept_id = $_SESSION['user']['dept_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memo_id = $_POST['memo_id'];
    $dept_id = $_POST['dept_id'];


  
    $sql = "UPDATE memos SET To_Department = $dept_id, Status = 'Forwarded' WHERE memo_id = $memo_id";
    $result = $conn->prepare($sql);
    // $result->bind_param("ii", $dept_id, $memo_id);
    
    if ($result->execute()) {
        
        echo json_encode(['success' => true, 'message' => 'Memo forwarded successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $result->error]);
    }

    // $result->close();
//     $conn>close();
}
