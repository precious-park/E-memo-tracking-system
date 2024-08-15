<?php
// Database connection
$host = 'localhost';
$db = 'memo_tracking';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Event Logging Function
function log_action($conn, $memo_id, $action_type, $user_email) {
    $stmt = $conn->prepare("INSERT INTO audit_trail (memo_id, action_type, action_date, user_email) VALUES (?, ?, NOW(), ?)");
    $stmt->bind_param("iss", $memo_id, $action_type, $user_email);
    $stmt->execute();
    $stmt->close();
}

// Create Memo
function create_memo($conn, $subject, $author_email, $to_department_id, $content, $attachments) {
    $stmt = $conn->prepare("INSERT INTO memos (subject, author_email, to_department_id, status, date, content, attachments) VALUES (?, ?, ?, 'Draft', NOW(), ?, ?)");
    $stmt->bind_param("ssiss", $subject, $author_email, $to_department_id, $content, $attachments);
    $stmt->execute();
    $memo_id = $stmt->insert_id;
    log_action($conn, $memo_id, 'Created', $author_email);
    $stmt->close();
    return $memo_id;
}

// Send Memo
function send_memo($conn, $memo_id, $user_email) {
    $stmt = $conn->prepare("UPDATE memos SET status = 'Sent', date = NOW() WHERE memo_id = ?");
    $stmt->bind_param("i", $memo_id);
    $stmt->execute();
    log_action($conn, $memo_id, 'Sent', $user_email);

    // Notify recipients (simplified example)
    $stmt = $conn->prepare("SELECT to_department_id FROM memos WHERE memo_id = ?");
    $stmt->bind_param("i", $memo_id);
    $stmt->execute();
    $stmt->bind_result($to_department_id);
    $stmt->fetch();
    $stmt->close();

    // Assuming we have an array of employee emails in the department
    $stmt = $conn->prepare("SELECT email FROM employees WHERE department_id = ?");
    $stmt->bind_param("i", $to_department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $recipient_email = $row['email'];
        // Send email to recipient (simplified)
        mail($recipient_email, "New Memo", "You have a new memo. Please check the memo tracking system.");
    }

    $stmt->close();
}

// Receive Memo
function receive_memo($conn, $memo_id, $department_id, $user_email) {
    $stmt = $conn->prepare("INSERT INTO recipient_status (memo_id, department_id, receipt_date, status) VALUES (?, ?, NOW(), 'Received') ON DUPLICATE KEY UPDATE receipt_date = NOW(), status = 'Received'");
    $stmt->bind_param("ii", $memo_id, $department_id);
    $stmt->execute();
    log_action($conn, $memo_id, 'Received', $user_email);
    $stmt->close();
}

// Generate Audit Report
function generate_audit_report($conn) {
    $stmt = $conn->prepare("SELECT * FROM audit_trail WHERE action_date >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
    $stmt->execute();
    $result = $stmt->get_result();
    $audit_logs = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Process and generate the report (simplified)
    foreach ($audit_logs as $log) {
        echo "Action: {$log['action_type']} - Memo ID: {$log['memo_id']} - User: {$log['user_email']} - Date: {$log['action_date']}<br>";
    }
}

// Check for Suspicious Activity
function check_for_suspicious_activity($conn) {
    $threshold = 5; // Example threshold
    $stmt = $conn->prepare("SELECT COUNT(*) FROM audit_trail WHERE action_type = 'Deleted' AND action_date >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $stmt->execute();
    $stmt->bind_result($delete_count);
    $stmt->fetch();
    $stmt->close();

    if ($delete_count > $threshold) {
        send_alert("High number of deletions detected in the last hour");
    }
}

function send_alert($message) {
    // Simplified alert sending
    mail("admin@example.com", "Alert", $message);
}

// Example usage
// Uncomment and adjust as needed for testing
// $memo_id = create_memo($conn, "Annual Leave Policy", "john.doe@example.com", 1, "Details of the new annual leave policy.", null);
// send_memo($conn, $memo_id, "john.doe@example.com");
// receive_memo($conn, $memo_id, 1, "hr.department@example.com");
// generate_audit_report($conn);
// check_for_suspicious_activity($conn);

$conn->close();
?>
