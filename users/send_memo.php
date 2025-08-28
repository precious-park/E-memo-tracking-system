<?php
include('includes/dbh.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

// Check if memo_id is provided
if (!isset($_POST['memo_id'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Memo ID is required']);
    exit;
}

$memo_id = intval($_POST['memo_id']);

try {
    // Update memo status to 'Sent'
    $stmt = $conn->prepare("UPDATE memos SET status = 'Sent' WHERE memo_id = ?");
    $stmt->bind_param("i", $memo_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => "Memo ID $memo_id has been sent."]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send the memo.']);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
