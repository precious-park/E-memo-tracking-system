<?php
// session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// header('Content-Type: application/json');

// // Include connection file
// require_once("includes/dbh.php");

// $user_email = $_SESSION['user']['email'];
// $dept_id = $_SESSION['user']['dept_id'];

// // Initialize variables
// $params = $_REQUEST;

// // Define index of columns
// $columns = array( 
//     0 => 'memo_id',
//     1 => 'subject',
//     2 => 'Author',
//     3 => 'To_Department',
//     4 => 'Status',
//     5 => 'date_created'
// );

// // Base SQL query
// $sql = "SELECT * FROM memos WHERE Author IN (SELECT email FROM users WHERE dept_id = ?)";

// // Add search functionality
// if (!empty($params['search']['value'])) {   
//     $search_value = "%" . $params['search']['value'] . "%";
//     $sql .= " AND (subject LIKE ? OR Author LIKE ? OR To_Department LIKE ? OR Status LIKE ? OR date_created LIKE ?)";
// }

// // Add ordering
// $sql .= " ORDER BY " . $columns[$params['order'][0]['column']] . " " . $params['order'][0]['dir'];

// // Add pagination
// $sql .= " LIMIT ?, ?";

// // Prepare the statement
// $stmt = $conn->prepare($sql);

// if (!empty($params['search']['value'])) {
//     $stmt->bind_param("issssii", $dept_id, $search_value, $search_value, $search_value, $search_value, $search_value, $params['start'], $params['length']);
// } else {
//     $stmt->bind_param("iii", $dept_id, $params['start'], $params['length']);
// }

// $stmt->execute();
// $result = $stmt->get_result();

// // Fetch all results
// $data = array();
// while ($row = $result->fetch_assoc()) {
//     $data[] = $row;
// }

// // Total records query without search
// $totalRecords = $conn->query("SELECT COUNT(*) FROM memos WHERE Author IN (SELECT email FROM users WHERE dept_id = $dept_id)")->fetch_row()[0];

// // Prepare JSON data
// $json_data = array(
//     "draw"            => intval($params['draw']),
//     "recordsTotal"    => intval($totalRecords),
//     "recordsFiltered" => intval($totalRecords),
//     "data"            => $data   // Total data array
// );

// echo json_encode($json_data);

// $conn->close();


error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include connection file
require_once("includes/dbh.php");

session_start();  // Start the session to access the session variables

// Assuming the department ID is stored in the session
$dept_id = $_SESSION['user']['dept_id'];

// Initialize variables
$params = $columns = $totalRecords = $data = array();
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

$where = $sqlTot = $sqlRec = "";

// Base SQL query with department filter
$sql = "SELECT * FROM memos WHERE Author IN (SELECT email FROM users WHERE dept_id = ?)";

// Check search value exist
if (!empty($params['search']['value'])) {   
    $where .= " AND ( subject LIKE '%" . $params['search']['value'] . "%' ";    
    $where .= " OR Author LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR To_Department LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR Status LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR date_created LIKE '%" . $params['search']['value'] . "%' )";
}

// Concatenate search SQL if value exists
$sqlTot = $sqlRec = $sql;

if (isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}

// Add ordering and pagination
$sqlRec .= " ORDER BY " . $columns[$params['order'][0]['column']] . " " . $params['order'][0]['dir'] . " LIMIT " . $params['start'] . ", " . $params['length'];

// Execute total records query
$queryTot = mysqli_query($conn, $sqlTot) or die("Database error: " . mysqli_error($conn));
$totalRecords = mysqli_num_rows($queryTot);

// Execute records query
$queryRecords = mysqli_query($conn, $sqlRec) or die("Error fetching memos data");

// Iterate through results and create new index array of data
while ($row = mysqli_fetch_assoc($queryRecords)) { 
    $data[] = $row;
}   

// Prepare JSON data
$json_data = array(
    "draw"            => intval($params['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // Total data array
);

echo json_encode($json_data);  // Send data as JSON format

// Close the connection
mysqli_close($conn);

