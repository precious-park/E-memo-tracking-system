<?php
include('includes/dbh.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memo_id = $_POST['memo_id'];

    // Fetch audit trail for the given memo_id
    $stmt = $conn->prepare("SELECT action_type, action_date, user_email FROM audit_log WHERE memo_id = ?");
    $stmt->bind_param("i", $memo_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $auditLogs = array();
    while ($row = $result->fetch_assoc()) {
        $auditLogs[] = $row;
    }

    echo json_encode($auditLogs); // Send data back as JSON
}

