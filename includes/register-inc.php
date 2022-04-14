<?php
    if (isset($_POST['submit'])) {
        require 'server.php'; // grab the database

        // INPUT
        $full_name = $_POST['fullName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['passwordConfirm'];
        $role_id = 2;
        $univ_id;

        // check for empty fields
        if (empty($full_name)) {
            // is fullName field empty
            header("location: ../register.php?error=emptyfield&fullNam&:".$full_name);
            exit();
        } elseif (empty($email)) {
             // is universityEmail field empty
             header("location: ../register.php?error=emptyfield&emai&:".$email);
             exit();
            // is username field empty
        } elseif (empty($username)) {
            header("location: ../register.php?error=emptyfield&usernam&:".$username);
            exit();
            // is password field empty
        } elseif (empty($password)) {
            header("location: ../register.php?error=emptyfield&passwor&:".$password);
            exit();
            // is passwordConfirm field empty
        } elseif (empty($password_confirm)) {
            header("location: ../register.php?error=emptyfield&passwordConfirm&:".$password_confirm);
            exit(); 
        
        // fields' character restrictions (optional)
        } elseif (!preg_match("/^[a-zA-Z0-9]*/",$username)) {
            header("location: ../register.php?error=invalid&usernam&:".$username);
            exit();
            // restrict the full_name to the a-zA-Z
        } elseif (!preg_match("/^[a-zA-Z]*/", $full_name)) {
            header("location: ../register.php?error=invalid&fullNam&:".$full_name);
            exit();
        
        // check if password is the same as confirmPass
        } elseif ($password !== $password_confirm) {
            header("location: ../register.php?error=passwordsdonotmatch&:".$password."!=".$password_confirm);
            exit();

        // REGISTRATION
        } else {
            // SAVE: univId into the user record
                // get univ_tag from the univ_email
            $pos = strpos($email, '@');
            $univ_tag = substr($email, $pos);
            $univ_tag_noesc = mysqli_real_escape_string($db, $univ_tag);
                // lookup and save univId using univ_tag
            $query = "SELECT univId FROM university WHERE univTag = '$univ_tag_noesc'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
                // CHECK: university in database
            if (!mysqli_num_rows($result)) {
                header("location: ../register.php?error=nosuchuniversity&:".$univ_tag."!=".$row['univId']);
                exit();
            } else {
                $univ_id = mysqli_query($db, $query);
            }

            $query = "SELECT username FROM user WHERE username = ?";
            $stmt = mysqli_stmt_init($db); // $stmt: initialize
            if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
                header("location: ../register.php?error=sqlerror");
                exit();
            } else {
                // CHECK_1: username taken
                mysqli_stmt_bind_param($stmt, "s", $username); // $stmt: bind needed parameters
                mysqli_stmt_execute($stmt); // $stmt: execute
                mysqli_stmt_store_result($stmt); // $stmt: store result into internal buffer
                $rowCount = mysqli_stmt_num_rows($stmt); // buffer: count rows
                // username found
                if ($rowCount > 0) {
                    header("location: ../register.php?error=usernametaken");
                    exit();   
                // REGISTER
                } else {
                    $query = "INSERT INTO user (fullName, univId, email, username, password, roleId) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($db); // $stmt: initialize
                    if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
                        header("location: ../register.php?error=sqlerror");
                        exit();
                    } else {
                        // SECURITY: password encryption (optional)
                        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sisssi", $full_name, $univ_id, $email, $username, $password, $role_id); // $stmt: bind needed parameters
                        if (mysqli_stmt_execute($stmt)) { // $stmt: execute
                            header("location: ../login.php?success=registered");
                        } else {
                            header("location: ../login.php?success=nameORemail=exists");
                            exit();
                        }
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>