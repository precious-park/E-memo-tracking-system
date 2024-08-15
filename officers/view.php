<?php
// Start session to get logged-in user info
session_start();

// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's email from session
$loggedInUserEmail = $_SESSION['user_email']; // Ensure this is set during login

// Fetch memos created by the logged-in user
$sql = "SELECT * FROM memos WHERE author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUserEmail);
$stmt->execute();
$result = $stmt->get_result();

// Store the memos in an array
$memos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $memos[] = $row;
    }
}
$stmt->close();

// Display the memos in HTML
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Outgoing Memos</title>
</head>
<body>
    <h1>Your Outgoing Memos</h1>
    <ul>
        <?php if (empty($memos)): ?>
            <li>You have not created any memos yet.</li>
        <?php else: ?>
            <?php foreach ($memos as $memo): ?>
                <li>
                    <a href="memo_details.php?id=<?php echo $memo['id']; ?>"><?php echo htmlspecialchars($memo['subject']); ?></a>
                    <!-- Optionally display additional memo details -->
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>

<?php
// Close the database connection
$conn->close();

