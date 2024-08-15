<?php
include 'includes/dbh.php';
// include 'event_logging.php';
function create_memo($conn, $subject, $author_email, $to_department_id, $content, $attachments) {
    $stmt = $conn->prepare("INSERT INTO memos (subject, author_email, to_department_id, status, date, content, attachments) VALUES (?, ?, ?, 'Draft', NOW(), ?, ?)");
    $stmt->bind_param("ssiss", $subject, $author_email, $to_department_id, $content, $attachments);
    $stmt->execute();
    $memo_id = $stmt->insert_id;
    log_action($conn, $memo_id, 'Created', $author_email);
    $stmt->close();
    return $memo_id;
}

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


$conn->close();

