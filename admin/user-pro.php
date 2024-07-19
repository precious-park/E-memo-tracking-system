<?php
include('includes/dbh.php');
// Set error reporting level to display all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);


$success_msg = $email_exist = $f_NameErr = $l_NameErr = $_emailErr = $_passwordErr = $_roleErr = $_departmentErr = "";
$fNameEmptyErr = $lNameEmptyErr = $emailEmptyErr = $passwordEmptyErr = $roleEmptyErr = $departmentEmptyErr = "";

$_first_name = $_last_name = $_email = $_password = $_role = $_department = "";

if (isset($_POST["submit"])) {
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $role = $_POST["role"];
    $department = $_POST["department"];

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($pwd) && !empty($role) && !empty($department)) {
        $email_check_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);

        if ($rowCount > 0) {
            $email_exist = '<div class="alert alert-danger" role="alert">User with email already exists!</div>';
        } else {
            // Sanitize input
            $_first_name = mysqli_real_escape_string($conn, $firstname);
            $_last_name = mysqli_real_escape_string($conn, $lastname);
            $_email = mysqli_real_escape_string($conn, $email);
            $_password = mysqli_real_escape_string($conn, $pwd);
            $_role = mysqli_real_escape_string($conn, $role);
            $_department = mysqli_real_escape_string($conn, $department);

            // Validation
            if (!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
                $f_NameErr = '<div class="alert alert-danger">Only letters and white space allowed.</div>';
            }
            if (!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
                $l_NameErr = '<div class="alert alert-danger">Only letters and white space allowed.</div>';
            }
            if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                $_emailErr = '<div class="alert alert-danger">Email format is invalid.</div>';
            }
            if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                $_passwordErr = '<div class="alert alert-danger">Password requirements not met.</div>';
            }
            if (!in_array($_role, ['admin', 'user'])) {
                $_roleErr = '<div class="alert alert-danger">Role should be either admin or user.</div>';
            }
            if (!is_numeric($_department)) {
                $_departmentErr = '<div class="alert alert-danger">Department should be a numeric value.</div>';
            }

            if (empty($f_NameErr) && empty($l_NameErr) && empty($_emailErr) && empty($_passwordErr) && empty($_roleErr) && empty($_departmentErr)) {
                $password_hash = password_hash($pwd, PASSWORD_BCRYPT);
                $sql = "INSERT INTO users (first_name, last_name, email, password, roles, dept_id, created_at) VALUES ('{$_first_name}', '{$_last_name}', '{$_email}', '{$password_hash}', '{$_role}', '{$_department}', now())";
                $sqlQuery = mysqli_query($conn, $sql);
                var_dump($sqlQuery);
                if (!$sqlQuery) {
                    die("MySQL query failed: " . mysqli_error($conn));
                } else {
                    $success_msg = '<div class="alert alert-success">Registration successful!</div>';
                }
            }
        }
    } else {
        if (empty($firstname)) {
            $fNameEmptyErr = '<div class="alert alert-danger">First name cannot be blank.</div>';
        }
        if (empty($lastname)) {
            $lNameEmptyErr = '<div class="alert alert-danger">Last name cannot be blank.</div>';
        }
        if (empty($email)) {
            $emailEmptyErr = '<div class="alert alert-danger">Email cannot be blank.</div>';
        }
        if (empty($pwd)) {
            $passwordEmptyErr = '<div class="alert alert-danger">Password cannot be blank.</div>';
        }
        if (empty($role)) {
            $roleEmptyErr = '<div class="alert alert-danger">Role cannot be blank.</div>';
        }
        if (empty($department)) {
            $departmentEmptyErr = '<div class="alert alert-danger">Department cannot be blank.</div>';
        }
    }
}
