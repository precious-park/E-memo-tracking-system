
<?php
session_start();
include_once 'includes/dbh.php';

// Assuming the department ID is stored in the session
$dept_id = $_SESSION['user']['dept_id'];
$status = 'pending';

// Prepare the SQL statement with placeholders
$sql = "SELECT * FROM memos WHERE to_dept=? AND status=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $dept_id, $status);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "From: " . $row["from_dept"]. "<br>";
        echo "Subject: " . $row["subject"]. "<br>"; 
        echo "Content: " . $row["content"]. "<br>";
        echo "Sent Date: " . $row["sent_date"]. "<br>";
        
        // Display options to receive/reject memo
        echo "<form action='memo_action.php' method='POST'>";
        echo "<input type='hidden' name='memo_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='action' value='receive'>Receive</button>";
        echo "<button type='submit' name='action' value='reject'>Reject</button>";
        echo "</form><br>";
    }
} else {
    echo "No memos received";
}

// Close the statement and connection
$stmt->close();
$conn->close();

