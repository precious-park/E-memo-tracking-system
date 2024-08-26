<?php
// get_departments.php
session_start();
include_once 'includes/dbh.php';
$current_dept = $_SESSION['user']['dept_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $sql = "SELECT * FROM departments WHERE dept_id != '$current_dept'";
    $result = $conn->query($sql);

    $options = '<option value="">Select Department</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
}

echo $options;
}

