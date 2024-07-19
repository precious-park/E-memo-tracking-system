<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include connection file
require_once("includes/dbh.php");

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

// Check search value exist
if (!empty($params['search']['value'])) {   
    $where .= " WHERE ";
    $where .= " ( subject LIKE '%" . $params['search']['value'] . "%' ";    
    $where .= " OR author LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR to_department LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR status LIKE '%" . $params['search']['value'] . "%' ";
    $where .= " OR date_created LIKE '%" . $params['search']['value'] . "%' )";
}

// Base SQL query
$sql = "SELECT * FROM `memos`";

// Total records query
$sqlTot .= $sql;
$sqlRec .= $sql;

// Concatenate search SQL if value exists
if (isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}

// Add ordering and pagination
$sqlRec .= " ORDER BY " . $columns[$params['order'][0]['column']] . " " . $params['order'][0]['dir'] . " LIMIT " . $params['start'] . " ," . $params['length'] . " ";

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
