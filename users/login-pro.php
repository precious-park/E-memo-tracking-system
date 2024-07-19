<?php
session_start();
// Database connection
include('includes/dbh.php');

// Initialize error variables
$wrongPwdErr = $accountNotExistErr = $emailPwdErr = $email_empty_err = $pass_empty_err = "";



if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Clean data
    $user_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pswd = mysqli_real_escape_string($connection, $pwd);

    // Query if email exists in db
    $sql = "SELECT * FROM users WHERE email = '{$user_email}'";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason 
    if (!$query) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if (!empty($email_signin) && !empty($password)) {
        if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
            $wrongPwdErr = '<div class="alert alert-danger">
                    Password should be between 6 to 20 characters long, contain at least one special character, lowercase, uppercase, and a digit.
                </div>';
        }
        // Check if email exists
        if ($rowCount <= 0) {
            $accountNotExistErr = '<div class="alert alert-danger">
                    User account does not exist.
                </div>';
        } else {
            // Fetch user data and store in PHP session
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $pass_word = $row['password'];
                $role = $row['role'];
                $is_active = $row['is_active'];
            }

            // Verify password
            if (password_verify($password, $pass_word)) {
                // Allow only verified users with role 'user'
                if ($is_active == '1' && $role == 'user') {
                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;

                    header("Location: dashboard.php");
                    exit();
                } elseif ($is_active != '1') {
                    $emailPwdErr = '<div class="alert alert-danger">
                            Account verification is required for login.
                        </div>';
                } else {
                    $emailPwdErr = '<div class="alert alert-danger">
                            Access denied. Only users with role "user" are allowed.
                        </div>';
                }
            } else {
                $emailPwdErr = '<div class="alert alert-danger">
                        Either email or password is incorrect.
                    </div>';
            }
        }
    } else {
        if (empty($email)) {
            $email_empty_err = "<div class='alert alert-danger email_alert'>
                        Email not provided.
                </div>";
        }
        
        if (empty($pwd)) {
            $pass_empty_err = "<div class='alert alert-danger email_alert'>
                        Password not provided.
                    </div>";
        }            
    }
}

