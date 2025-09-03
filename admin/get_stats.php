<?php
session_start();
include('includes/dbh.php');

// Count users
$resultUsers = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = $rowUsers['total_users'];

// Count memos
$resultMemos = $conn->query("SELECT COUNT(*) AS total_memos FROM memos");
$rowMemos = $resultMemos->fetch_assoc();
$totalMemos = $rowMemos['total_memos'];

// Count departments
$resultDepartments = $conn->query("SELECT COUNT(*) AS total_departments FROM departments");
$totalDepartments = $resultDepartments->fetch_assoc()['total_departments'];
// Return JSON
header('Content-Type: application/json');
echo json_encode([
    "total_users" => $totalUsers,
    "total_memos" => $totalMemos,
    "total_departments" => $totalDepartments
]);
