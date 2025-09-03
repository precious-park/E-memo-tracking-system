<?php
include('includes/dbh.php');

$result = $conn->query("SELECT dept_id, dept_name FROM departments");

$departments = array();
while($row = $result->fetch_assoc()){
    $departments[] = $row;
}

header('Content-Type: application/json');
echo json_encode($departments);
?>


