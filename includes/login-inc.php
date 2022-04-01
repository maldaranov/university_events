<?php

if (isset($_POST['submit'])) {
    require 'server.php'; // grab the database

    // INPUT
    $username = $_POST['username'];
    $password = $_POST['password'];

    // CHECK: empty fields
        // if username field is empty
    if (empty($username)) {
        header("location: ../login.php?error=emptyfield&username");
        exit();
        // if password field is empty
    } elseif (empty($password)) {
        header("location: ../login.php?error=emptyfield&username");
        exit();

    // CHECK: account found  
    } else {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = mysqli_stmt_init($db); // $stmt: initialize
        if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
            header("location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username); // $stmt: bind needed parameters
            mysqli_stmt_execute($stmt); // $stmt: execute
            $result = mysqli_stmt_get_result($stmt); // $stmt: get result

            // CHECK 1: username exists -> fetch the row of that username
            if ($row = mysqli_fetch_assoc($result)) {
                // SECURITY: password decryption (optional)
                // $passCheck = password_verify($password, $row['password']);
                // if password do not match
                if (strcmp($password,$row['password']) != 0) {
                    header("location: ../login.php?wrongpassword");
                    exit();
                // CHECK 2: validate password
                } else {
                    session_start();
                    $_SESSION['user_id'] = $row['userId'];
                    $_SESSION['user_fullname'] = $row['fullName'];
                    $_SESSION['user_univid'] = $row['univId'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_username'] = $row['username'];
                    $_SESSION['user_password'] = $row['password'];
                    $_SESSION['user_roleid'] = $row['roleId'];      
                    header("location: ../index.php?success=loggedin");
                    exit();
                } 
            } else {
                header("location: ../login.php?error=nosuchuser");
                exit();
            }   
        }
    }
} else {
    header("location: ../index.php?error=accessforbidden");
    exit();
}

?>