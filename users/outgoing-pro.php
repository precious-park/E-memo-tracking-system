<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Include connection file
require_once("includes/dbh.php");

$user_email = $_SESSION['user']['email'];
$dept_id = $_SESSION['user']['dept_id'];

// Initialize variables
$params = $_REQUEST;

// Define index of columns
$columns = array( 
    0 => 'memo_id',
    1 => 'subject',
    2 => 'Author',
    3 => 'To_Department',
    4 => 'Status',
    5 => 'date_created'
);

// Base SQL query
$sql = "SELECT * FROM memos WHERE Author IN (SELECT email FROM users WHERE dept_id = ?)";

// Add search functionality
if (!empty($params['search']['value'])) {   
    $search_value = "%" . $params['search']['value'] . "%";
    $sql .= " AND (subject LIKE ? OR Author LIKE ? OR To_Department LIKE ? OR Status LIKE ? OR date_created LIKE ?)";
}

// Add ordering
$sql .= " ORDER BY " . $columns[$params['order'][0]['column']] . " " . $params['order'][0]['dir'];

// Add pagination
$sql .= " LIMIT ?, ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

if (!empty($params['search']['value'])) {
    $stmt->bind_param("issssii", $dept_id, $search_value, $search_value, $search_value, $search_value, $search_value, $params['start'], $params['length']);
} else {
    $stmt->bind_param("iii", $dept_id, $params['start'], $params['length']);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch all results
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Total records query without search
$totalRecords = $conn->query("SELECT COUNT(*) FROM memos WHERE Author IN (SELECT email FROM users WHERE dept_id = $dept_id)")->fetch_row()[0];

// Prepare JSON data
$json_data = array(
    "draw"            => intval($params['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // Total data array
);

echo json_encode($json_data);

$conn->close();
